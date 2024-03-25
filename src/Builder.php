<?php

namespace LSP;

use Exception;
use ReflectionClass;

trait Builder
{
    public static function from(object $object): static
    {
        $reflection = new ReflectionClass(static::class);

        $static = new static();

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $type = $property->getType();

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
                    $typeReflection = new ReflectionClass($type);

                    if (in_array(__TRAIT__, $typeReflection->getTraitNames())) {
                        $static->$name = [];
                        foreach ($object->$name as $obj) {
                            $static->$name[] = $type::from($obj);
                        }
                    } else {
                        throw new Exception("{$type} does not have trait Builder");
                    }
                } else {
                    $static->$name = $object->$name;
                }
            } else {
                if ($type->isBuiltin()) {
                    $static->$name = $object->$name;
                } else {
                    $type = $type->getName();
                    $typeReflection = new ReflectionClass($type);

                    if (in_array(__TRAIT__, $typeReflection->getTraitNames())) {
                        $static->$name = $type::from($object->$name);
                    } else {
                        throw new Exception("{$type} does not have trait Builder");
                    }
                }
            }
        }

        return $static;
    }
}
