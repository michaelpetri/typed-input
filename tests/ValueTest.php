<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\TestCase;
use Psl\Type\Exception\CoercionException;

final class ValueTest extends TestCase
{
    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider booleanProvider
     */
    public function testAsBoolean(mixed $raw, bool $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBoolean());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider booleanOrNullProvider
     */
    public function testAsBooleanOrNull(mixed $raw, ?bool $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBooleanOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider integerProvider
     */
    public function testAsInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider integerProvider
     */
    public function testAsIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int $expected
     * @dataProvider positiveIntegerProvider
     */
    public function testAsPositiveInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider nonPositiveIntegerOrNullProvider
     */
    public function testFailAsPositiveInteger(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asPositiveInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|null $expected
     * @dataProvider positiveIntegerOrNullProvider
     */
    public function testAsPositiveIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider nonPositiveIntegerProvider
     */
    public function testFailAsPositiveIntegerOrNull(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asPositiveIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|0 $expected
     * @dataProvider naturalIntegerProvider
     */
    public function testAsNaturalInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNaturalInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider negativeIntegerOrNullProvider
     */
    public function testFailAsNaturalInteger(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asNaturalInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|0|null $expected
     * @dataProvider naturalIntegerOrNullProvider
     */
    public function testAsNaturalIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNaturalIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider negativeIntegerProvider
     */
    public function testFailAsNaturalIntegerOrNull(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asNaturalIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider stringProvider
     */
    public function testAsString(mixed $raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asString());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider stringOrNullProvider
     */
    public function testAsStringOrNull(mixed $raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     * @dataProvider nonEmptyStringProvider
     */
    public function testAsNonEmptyString(mixed $raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringOrNullProvider
     */
    public function testFailAsNonEmptyString(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asNonEmptyString();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string|null $expected
     * @dataProvider nonEmptyStringOrNullProvider
     */
    public function testAsNonEmptyStringOrNull(mixed $raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNonEmptyStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringProvider
     */
    public function testFailAsNonEmptyStringOrNull(mixed $raw): void
    {
        $value = new Value($raw);
        $this->expectException(CoercionException::class);
        $value->asNonEmptyStringOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     * @dataProvider nonEmptyStringProvider
     */
    public function testAsNonEmptyStrings(mixed $raw, string $expected): void
    {
        $value = new Value([$raw, $raw]);
        self::assertEquals([$expected, $expected], $value->asNonEmptyStrings());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringOrNullProvider
     */
    public function testFailAsNonEmptyStrings(mixed $raw): void
    {
        $value = new Value([$raw, $raw]);
        $this->expectException(CoercionException::class);
        $value->asNonEmptyStrings();
    }

    /** @dataProvider numericProvider */
    public function testAsNumeric(string $raw, int|float $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNumeric());
    }

    public function testAsNumericFailsForString(): void
    {
        $value = new Value('non-empty-string');
        $this->expectException(CoercionException::class);
        $value->asNumeric();
    }

    /** @dataProvider numericProvider */
    public function testAsNumericOrNull(string|null $raw, int|float|null $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNumericOrNull());
    }

    /**
     * @dataProvider dateTimeProvider
     *
     * @psalm-param class-string|null $expectedException
     */
    public function testAsDateTimeImmutable(mixed $raw, string $format, string $expectedInAtoMFormat): void
    {
        $value = new Value($raw);
        self::assertEquals(
            $expectedInAtoMFormat,
            $value->asDateTimeImmutable($format)->format(\DateTimeInterface::ATOM)
        );
    }

    public function testAsDateTimeImmutableFailsForNull(): void
    {
        $value = new Value(null);

        $this->expectException(CoercionException::class);
        $value->asDateTimeImmutable('Y-m-d');
    }

    public function testAsDateTimeImmutableFailsForWrongFormat(): void
    {
        $value = new Value('06.02.2023');

        $this->expectException(CoercionException::class);
        $value->asDateTimeImmutable('Y-m-d');
    }

    public static function dateTimeProvider(): iterable
    {
        yield [
            '2023-02-06',
            '!Y-m-d+',
            '2023-02-06T00:00:00+00:00'
        ];
        yield [
            '2023-02-06T11:42:52+01:00',
            \DateTimeInterface::ATOM,
            '2023-02-06T11:42:52+01:00'
        ];
    }

    /**
     * @psalm-return iterable<array{
     *     bool,
     *     bool,
     * }>
     */
    public static function booleanProvider(): iterable
    {
        yield [true, true];
        yield [false, false];
    }

    /**
     * @psalm-return iterable<array{
     *     bool|null,
     *     bool|null,
     * }>
     */
    public static function booleanOrNullProvider(): iterable
    {
        yield from self::booleanProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     int,
     * }>
     */
    public static function integerProvider(): iterable
    {
        yield from self::naturalIntegerProvider();
        yield from self::negativeIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string|null,
     *     int|null,
     * }>
     */
    public static function integerOrNullProvider(): iterable
    {
        yield from self::integerProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     '0',
     *     0,
     * }>
     */
    private static function zeroIntegerProvider(): iterable
    {
        yield ['0', 0];
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     positive-int,
     * }>
     */
    public static function positiveIntegerProvider(): iterable
    {
        yield ['1', 1];
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string|null,
     *     int|null,
     * }>
     */
    public static function positiveIntegerOrNullProvider(): iterable
    {
        yield from self::positiveIntegerProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     positive-int|0,
     * }>
     */
    public static function naturalIntegerProvider(): iterable
    {
        yield from self::zeroIntegerProvider();
        yield from self::positiveIntegerProvider();
    }

    public static function naturalIntegerOrNullProvider(): iterable
    {
        yield from self::naturalIntegerProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     int,
     * }>
     */
    public static function negativeIntegerProvider(): iterable
    {
        yield ['-1', -1];
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string|null,
     *     int|null,
     * }>
     */
    public static function negativeIntegerOrNullProvider(): iterable
    {
        yield from self::negativeIntegerProvider();
        yield [null, null];
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     int,
     * }>
     */
    public static function nonPositiveIntegerProvider(): iterable
    {
        yield from self::negativeIntegerProvider();
        yield from self::zeroIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string|null,
     *     int|null,
     * }>
     */
    public static function nonPositiveIntegerOrNullProvider(): iterable
    {
        yield from self::negativeIntegerOrNullProvider();
        yield from self::zeroIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     string,
     *     string,
     * }>
     */
    public static function stringProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield from self::emptyStringProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     string|null,
     *     string|null,
     * }>
     */
    public static function stringOrNullProvider(): iterable
    {
        yield from self::stringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     string,
     *     string,
     * }>
     */
    public static function emptyStringProvider(): iterable
    {
        yield ['', ''];
    }

    /**
     * @psalm-return iterable<array{
     *     string|null,
     *     string|null,
     * }>
     */
    public static function emptyStringOrNullProvider(): iterable
    {
        yield from self::emptyStringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string,
     *     non-empty-string,
     * }>
     */
    public static function nonEmptyStringProvider(): iterable
    {
        yield [' ', ' '];
        yield ['non-empty-string', 'non-empty-string'];
        yield ['true', 'true'];
        yield ['false', 'false'];
        yield ['1', '1'];
        yield ['0', '0'];
        yield ['-1', '-1'];
    }

    /**
     * @psalm-return iterable<array{
     *     non-empty-string|null,
     *     non-empty-string|null,
     * }>
     */
    public static function nonEmptyStringOrNullProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     null,
     *     null,
     * }>
     */
    public static function nullProvider(): iterable
    {
        yield [null, null];
    }

    /** @psalm-return iterable<array{non-empty-string, float|int}> */
    public static function numericProvider(): iterable
    {
        yield from self::integerProvider();
        yield ['-1.1', -1.1];
        yield ['1.1', 1.1];
    }

    /** @psalm-return iterable<array{non-empty-string|null, float|int|null}> */
    public static function numericOrNullProvider(): iterable
    {
        yield from self::nullProvider();
        yield from self::numericProvider();
    }
}
