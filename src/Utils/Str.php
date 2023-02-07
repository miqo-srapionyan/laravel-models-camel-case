<?php

declare(strict_types = 1);

namespace Miqo\LaravelModelsCamelCase\Utils;

use function lcfirst;
use function explode;
use function str_replace;
use function array_map;
use function mb_strtoupper;
use function mb_substr;
use function ctype_lower;
use function preg_replace;
use function ucwords;
use function mb_strtolower;
use function implode;

/**
 * Class Str is a helper class to work with strings.
 */
class Str
{
    /**
     * The cache of snake-cased words.
     *
     * @var array
     */
    protected static array $snakeCache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array
     */
    protected static array $camelCache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    protected static array $studlyCache = [];

    /**
     * Convert a value to camel case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function camel(string $value): string
    {
        if (isset(static::$camelCache[$value])) {
            return static::$camelCache[$value];
        }

        return static::$camelCache[$value] = lcfirst(static::studly($value));
    }

    /**
     * Convert a string to snake case.
     *
     * @param string $value
     * @param string $delimiter
     *
     * @return string
     */
    public static function snake(string $value, string $delimiter = '_'): string
    {
        $key = $value;

        if (isset(static::$snakeCache[$key][$delimiter])) {
            return static::$snakeCache[$key][$delimiter];
        }

        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value), 'UTF-8');
        }

        return static::$snakeCache[$key][$delimiter] = $value;
    }

    /**
     * Convert a value to studly caps case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function studly(string $value): string
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $words = explode(' ', str_replace(['-', '_'], ' ', $value));

        $studlyWords = array_map(
            fn($word) => mb_strtoupper(mb_substr($word, 0, 1), 'UTF-8').mb_substr($word, 1, null, 'UTF-8'),
            $words
        );

        return static::$studlyCache[$key] = implode($studlyWords);
    }
}
