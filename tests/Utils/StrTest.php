<?php

declare(strict_types = 1);

namespace Barryvdh\Debugbar\Tests\Utils;

use Miqo\LaravelModelsCamelCase\Utils\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function testCamelCase_WhenGivenKebabCaseString_ReturnsCamelCasedString(): void
    {
        $string = 'kebab-case-string';

        $result = Str::camel($string);

        $this->assertEquals('kebabCaseString', $result);
    }

    public function testCamelCase_WhenGivenRandomStringString_ReturnsCamelCasedString(): void
    {
        $string = 'raNDoM--__stRing1';

        $result = Str::camel($string);

        $this->assertEquals('raNDoMStRing1', $result);
    }

    public function testSnakeCase_WhenGivenKebabCaseString_ReturnsCamelCasedString(): void
    {
        $string = 'camelCaseString';

        $result = Str::snake($string);

        $this->assertEquals('camel_case_string', $result);
    }

    public function testSnakeCase_WhenGivenRandomStringString_ReturnsCamelCasedString(): void
    {
        $string = 'raNDoM--__stRing1';

        $result = Str::snake($string);

        $this->assertEquals('ra_n_do_m--__st_ring1', $result);
    }
}
