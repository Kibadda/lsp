<?php

namespace LSP;

use Exception;
use LSP\Protocol\Type\Method;
use LSP\RPC\IncomingMessage;
use ReflectionClass;
use ReflectionNamedType;
use UnitEnum;

class Builder
{
    public static function build(IncomingMessage $message): ?Handler
    {
        $method = Method::tryFrom($message->method);

        if (!$method instanceof Method) {
            return null;
        }

        $className = $method->class();

        if (!class_exists($className)) {
            throw new Exception("class {$className} does not exist");
        }

        $class = self::buildClass($message, $className);

        if (!$class instanceof Handler) {
            throw new Exception('incorrect build. expected: ' . Handler::class . ', actual: ' . $class::class);
        }

        return $class;
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    public static function buildClass(object $message, string $class)
    {
        if (!class_exists($class)) {
            throw new Exception("class {$class} does not exist");
        }

        $reflection = new ReflectionClass($class);
        $default = $reflection->getDefaultProperties();
        $arguments = [];

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $type = $property->getType();

            if (!$type instanceof ReflectionNamedType) {
                throw new Exception("could not handle non named type");
            }

            if (!$type->allowsNull() && !property_exists($message, $name)) {
                throw new Exception("missing property {$name}");
            }

            if ($type->allowsNull() && !property_exists($message, $name)) {
                continue;
            }


            if ($type->getName() == 'array') {
                if (!is_array($message->$name)) {
                    throw new Exception("expected array for property {$name}");
                }

                $comment = $reflection->getConstructor()?->getDocComment();

                if (!is_null($comment) && $comment !== false && preg_match('/@param\s+([^\[]+)\[\]\s+\$' . $name . '/', $comment, $matches)) {
                    $type = $matches[1];
                    if (!str_starts_with($type, '\\')) {
                        $type = "{$reflection->getNamespaceName()}\\{$type}";
                    }

                    if (!class_exists($type)) {
                        throw new Exception("class {$type} does not exist");
                    }

                    $arguments[$name] = [];
                    foreach ($message->$name as $obj) {
                        $arguments[$name][] = self::buildClass($obj, $type);
                    }
                } else {
                    $arguments[$name] = $message->$name;
                }
            } else if (self::is_enum($type)) {
                $enum = $type->getName();
                $try = $enum::tryFrom($message->$name);

                if (!$try instanceof $enum) {
                    throw new Exception("{$message->$name} is not a valid value for {$type}");
                }

                if (!empty($default[$name]) && $default[$name]->value != $message->$name) {
                    throw new Exception("wrong value for {$name}. expected: {$default[$name]->value}. actual: {$message->$name}");
                }

                $arguments[$name] = $try;
            } else {
                if ($type->isBuiltin()) {
                    if (!empty($default[$name]) && $default[$name] != $message->$name) {
                        throw new Exception("wrong value for {$name}. expected: {$default[$name]}. actual: {$message->$name}");
                    }

                    $arguments[$name] = $message->$name;
                } else {
                    $type = $type->getName();

                    if (!class_exists($type)) {
                        throw new Exception("class {$type} does not exist");
                    }

                    $arguments[$name] = self::buildClass($message->$name, $type);
                }
            }
        }

        return new $class(...$arguments);
    }

    private static function is_enum(string $class): bool
    {
        if (!class_exists($class)) {
            return false;
        }

        $reflection = new ReflectionClass($class);

        return $reflection->isSubclassOf(UnitEnum::class);
    }
}
