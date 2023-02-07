<?php

declare(strict_types = 1);

namespace Miqo\LaravelModelsCamelCase\Traits;

use Miqo\LaravelModelsCamelCase\Utils\Str;

use function method_exists;

/**
 * Trait AttributesCamelCase must be used in Laravel model.
 * Changes all Model attributes, converting it to camelCase.
 */
trait AttributesCamelCase
{
    /**
     * Get an attribute from the model.
     * Check if any method exists with $key, if yes then do not convert it into camel case.
     * Because this is maybe a relation.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        return method_exists($this, $key) ? parent::getAttribute($key) : parent::getAttribute(Str::snake($key));
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        return parent::setAttribute(Str::snake($key), $value);
    }

    /**
     * Get the instance as an array.
     * Convert all snake cased attributes to camel case on array conversion.
     *
     * @return array
     */
    public function toArray()
    {
        $array = parent::toArray();
        $camelArray = [];

        foreach ($array as $name => $value) {
            $camelArray[Str::camel($name)] = $value;
        }

        return $camelArray;
    }
}
