<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use InvalidArgumentException;
use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\TestCase;
use TypeError;

final class ValueTest extends TestCase
{
    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider booleanProvider
     */
    public function testAsBoolean($raw, bool $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBoolean());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider booleanOrNullProvider
     */
    public function testAsBooleanOrNull($raw, ?bool $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asBooleanOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider integerProvider
     */
    public function testAsInteger($raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider integerProvider
     */
    public function testAsIntegerOrNull($raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int $expected
     * @dataProvider positiveIntegerProvider
     */
    public function testAsPositiveInteger($raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider nonPositiveIntegerOrNullProvider
     */
    public function testFailAsPositiveInteger($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|null $expected
     * @dataProvider positiveIntegerOrNullProvider
     */
    public function testAsPositiveIntegerOrNull($raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asPositiveIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider nonPositiveIntegerProvider
     */
    public function testFailAsPositiveIntegerOrNull($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|0 $expected
     * @dataProvider naturalIntegerProvider
     */
    public function testAsNaturalInteger($raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNaturalInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider negativeIntegerOrNullProvider
     */
    public function testFailAsNaturalInteger($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNaturalInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|0|null $expected
     * @dataProvider naturalIntegerOrNullProvider
     */
    public function testAsNaturalIntegerOrNull($raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNaturalIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider negativeIntegerProvider
     */
    public function testFailAsNaturalIntegerOrNull($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNaturalIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider stringProvider
     */
    public function testAsString($raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asString());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider stringOrNullProvider
     */
    public function testAsStringOrNull($raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     * @dataProvider nonEmptyStringProvider
     */
    public function testAsNonEmptyString($raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringOrNullProvider
     */
    public function testFailAsNonEmptyString($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyString();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string|null $expected
     * @dataProvider nonEmptyStringOrNullProvider
     */
    public function testAsNonEmptyStringOrNull($raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertEquals($expected, $value->asNonEmptyStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringProvider
     */
    public function testFailAsNonEmptyStringOrNull($raw): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStringOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     * @dataProvider nonEmptyStringProvider
     */
    public function testAsNonEmptyStrings($raw, string $expected): void
    {
        $value = new Value([$raw, $raw]);
        self::assertEquals([$expected, $expected], $value->asNonEmptyStrings());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @dataProvider emptyStringOrNullProvider
     */
    public function testFailAsNonEmptyStrings($raw): void
    {
        $value = new Value([$raw, $raw]);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStrings();
    }

    /**
     * @dataProvider dateTimeProvider
     *
     * @psalm-param mixed $raw
     * @psalm-param class-string|null $expectedException
     */
    public function testAsDateTimeImmutable($raw, ?string $expectedException, $expected): void
    {
        $value = new Value($raw);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $date = $value->asDateTimeImmutable();

        self::assertEquals($expected, $date->format(\DateTimeInterface::ATOM));
    }

    public static function dateTimeProvider(): iterable
    {
        yield [null, InvalidArgumentException::class, null];
        yield [1234, InvalidArgumentException::class, null];
        yield ['blub', TypeError::class, null];
        yield ['20221111', null, '2022-11-11T00:00:00+00:00'];
        yield ['2022-11-11', null, '2022-11-11T00:00:00+00:00'];
    }

    /**
     * @psalm-return iterable<array{
     *     0: bool,
     *     1: bool,
     * }>
     */
    public static function booleanProvider(): iterable
    {
        yield [true, true];
        yield [false, false];
    }

    /**
     * @psalm-return iterable<array{
     *     0: bool|null,
     *     1: bool|null,
     * }>
     */
    public static function booleanOrNullProvider(): iterable
    {
        yield from self::booleanProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: int,
     * }>
     */
    public static function integerProvider(): iterable
    {
        yield from self::naturalIntegerProvider();
        yield from self::negativeIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string|null,
     *     1: int|null,
     * }>
     */
    public static function integerOrNullProvider(): iterable
    {
        yield from self::integerProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: '0',
     *     1: 0,
     * }>
     */
    private static function zeroIntegerProvider(): iterable
    {
        yield ['0', 0];
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: positive-int,
     * }>
     */
    public static function positiveIntegerProvider(): iterable
    {
        yield ['1', 1];
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string|null,
     *     1: int|null,
     * }>
     */
    public static function positiveIntegerOrNullProvider(): iterable
    {
        yield from self::positiveIntegerProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: positive-int|0,
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
     *     0: non-empty-string,
     *     1: int,
     * }>
     */
    public static function negativeIntegerProvider(): iterable
    {
        yield ['-1', -1];
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string|null,
     *     1: int|null,
     * }>
     */
    public static function negativeIntegerOrNullProvider(): iterable
    {
        yield from self::negativeIntegerProvider();
        yield [null, null];
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: int,
     * }>
     */
    public static function nonPositiveIntegerProvider(): iterable
    {
        yield from self::negativeIntegerProvider();
        yield from self::zeroIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string|null,
     *     1: int|null,
     * }>
     */
    public static function nonPositiveIntegerOrNullProvider(): iterable
    {
        yield from self::negativeIntegerOrNullProvider();
        yield from self::zeroIntegerProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: string,
     *     1: string,
     * }>
     */
    public static function stringProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield from self::emptyStringProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: string|null,
     *     1: string|null,
     * }>
     */
    public static function stringOrNullProvider(): iterable
    {
        yield from self::stringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: string,
     *     1: string,
     * }>
     */
    public static function emptyStringProvider(): iterable
    {
        yield ['', ''];
    }

    /**
     * @psalm-return iterable<array{
     *     0: string|null,
     *     1: string|null,
     * }>
     */
    public static function emptyStringOrNullProvider(): iterable
    {
        yield from self::emptyStringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: non-empty-string,
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
     *     0: non-empty-string|null,
     *     1: non-empty-string|null,
     * }>
     */
    public static function nonEmptyStringOrNullProvider(): iterable
    {
        yield from self::nonEmptyStringProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: null,
     *     1: null,
     * }>
     */
    private static function nullProvider(): iterable
    {
        yield [null, null];
    }
}
