<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use InvalidArgumentException;
use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{
    /** @dataProvider booleanProvider */
    public function testAsBoolean($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBoolean());
    }

    /** @dataProvider booleanOrNullProvider */
    public function testAsBooleanOrNull($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBooleanOrNull());
    }

    /** @dataProvider integerProvider */
    public function testAsInteger($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asInteger());
    }

    /** @dataProvider integerProvider */
    public function testAsIntegerOrNull($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asIntegerOrNull());
    }

    /** @dataProvider positiveIntegerProvider */
    public function testAsPositiveInteger($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveInteger());
    }

    /** @dataProvider nonPositiveIntegerOrNullProvider */
    public function testFailAsPositiveInteger($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveInteger();
    }

    /** @dataProvider positiveIntegerOrNullProvider */
    public function testAsPositiveIntegerOrNull($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveIntegerOrNull());
    }

    /** @dataProvider nonPositiveIntegerProvider */
    public function testFailAsPositiveIntegerOrNull($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveIntegerOrNull();
    }

    /** @dataProvider stringProvider */
    public function testAsString($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asString());
    }

    /** @dataProvider stringOrNullProvider */
    public function testAsStringOrNull($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /** @dataProvider nonEmptyStringProvider */
    public function testAsNonEmptyString($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /** @dataProvider emptyStringOrNullProvider */
    public function testFailAsNonEmptyString($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyString();
    }

    /** @dataProvider nonEmptyStringOrNullProvider */
    public function testAsNonEmptyStringOrNull($raw, $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNonEmptyStringOrNull());
    }

    /** @dataProvider emptyStringProvider */
    public function testFailAsNonEmptyStringOrNull($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStringOrNull();
    }

    /** @dataProvider nonEmptyStringProvider */
    public function testAsNonEmptyStrings($raw, $expected): void
    {
        $value = new Value([$raw, $raw]);
        self::assertEquals([$expected, $expected], $value->asNonEmptyStrings());
    }

    /** @dataProvider emptyStringOrNullProvider */
    public function testFailAsNonEmptyStrings($raw): void
    {
        $value = new Value([$raw, $raw]);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStrings();
    }

    public static function booleanProvider(): iterable
    {
        yield [true, true];
        yield [false, false];
    }

    public static function booleanOrNullProvider(): iterable
    {
        yield from self::booleanProvider();
        yield [null, null];
    }

    public static function integerProvider(): iterable
    {
        yield ['1', 1];
        yield [1, 1];
        yield [0, 0];
        yield [-1, -1];
        yield ['-1', -1];
    }

    public static function integerOrNullProvider(): iterable
    {
        yield from self::integerProvider();
        yield [null, null];
    }

    public static function positiveIntegerProvider(): iterable
    {
        yield [1, 1];
    }

    public static function positiveIntegerOrNullProvider(): iterable
    {
        yield from static::positiveIntegerProvider();
        yield [null, null];
    }

    public static function negativeIntegerProvider(): iterable
    {
        yield [-1, -1];
    }

    public static function negativeIntegerOrNullProvider(): iterable
    {
        yield from static::negativeIntegerProvider();
        yield [null, null];
    }

    public static function nonPositiveIntegerProvider(): iterable
    {
        yield from self::negativeIntegerProvider();
        yield [0, 0];
    }

    public static function nonPositiveIntegerOrNullProvider(): iterable
    {
        yield from self::negativeIntegerOrNullProvider();
        yield [0, 0];
    }

    public static function stringProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield ['', ''];
    }

    public static function stringOrNullProvider(): iterable
    {
        yield from self::stringProvider();
        yield [null, null];
    }

    public static function emptyStringProvider(): iterable
    {
        yield ['', ''];
    }

    public static function emptyStringOrNullProvider(): iterable
    {
        yield from self::emptyStringProvider();
        yield [null, null];
    }

    public static function nonEmptyStringProvider(): iterable
    {
        yield [' ', ' '];
        yield ['non-empty-string', 'non-empty-string'];
        yield [1, '1'];
    }

    public static function nonEmptyStringOrNullProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield [null, null];
    }
}
