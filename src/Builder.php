<?php

namespace LSP;

use Exception;
use ReflectionClass;
use ReflectionNamedType;
use UnitEnum;

trait Builder
{
    public static function from(object $object): self
    {
        $reflection = new ReflectionClass(self::class);
        $default = $reflection->getDefaultProperties();
        $arguments = [];

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $type = $property->getType();

            if (!$type instanceof ReflectionNamedType) {
                throw new Exception("could not handle non named type");
            }

            if (!$type->allowsNull() && !property_exists($object, $name)) {
                throw new Exception("missing property {$name}");
            }

            if ($type->allowsNull() && !property_exists($object, $name)) {
                continue;
            }


            if ($type->getName() == 'array') {
                if (!is_array($object->$name)) {
                    throw new Exception("expected array for property {$name}");
                }

                $comment = $property->getDocComment();

                if ($comment !== false && preg_match('/@var\s+([^\[]+)/', $comment, $matches)) {
                    $type = $matches[1];
                    if (!str_starts_with($type, '\\')) {
                        $type = "{$reflection->getNamespaceName()}\\{$type}";
                    }

                    if (!class_exists($type)) {
                        throw new Exception("class {$type} does not exist");
                    }

                    $typeReflection = new ReflectionClass($type);

                    if (in_array(__TRAIT__, $typeReflection->getTraitNames())) {
                        $arguments[$name] = [];
                        foreach ($object->$name as $obj) {
                            $arguments[$name][] = $type::from($obj);
                        }
                    } else {
                        throw new Exception("{$type} does not have trait Builder");
                    }
                } else {
                    $arguments[$name] = $object->$name;
                }
            } else if (self::is_enum($type)) {
                $enum = $type->getName();
                $try = $enum::tryFrom($object->$name);

                if (!$try instanceof $enum) {
                    throw new Exception("{$object->$name} is not a valid value for {$type}");
                }

                if (!empty($default[$name]) && $default[$name]->value != $object->$name) {
                    throw new Exception("wrong value for {$name}. expected: {$default[$name]->value}. actual: {$object->$name}");
                }

                $arguments[$name] = $try;
            } else {
                if ($type->isBuiltin()) {
                    if (!empty($default[$name]) && $default[$name] != $object->$name) {
                        throw new Exception("wrong value for {$name}. expected: {$default[$name]}. actual: {$object->$name}");
                    }

                    $arguments[$name] = $object->$name;
                } else {
                    $type = $type->getName();

                    if (!class_exists($type)) {
                        throw new Exception("class {$type} does not exist");
                    }

                    $typeReflection = new ReflectionClass($type);

                    if (in_array(__TRAIT__, $typeReflection->getTraitNames())) {
                        $arguments[$name] = $type::from($object->$name);
                    } else {
                        throw new Exception("{$type} does not have trait Builder");
                    }
                }
            }
        }

        return new self(...$arguments);
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
