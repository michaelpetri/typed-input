<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use DateTimeInterface;
use InvalidArgumentException;
use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Value::class)]
final class ValueTest extends TestCase
{
    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('booleanProvider')]
    public function testAsBoolean(mixed $raw, bool $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asBoolean());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('booleanOrNullProvider')]
    public function testAsBooleanOrNull(mixed $raw, ?bool $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asBooleanOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('integerProvider')]
    public function testAsInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('integerOrNullProvider')]
    public function testAsIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int $expected
     */
    #[DataProvider('positiveIntegerProvider')]
    public function testAsPositiveInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asPositiveInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('nonPositiveIntegerOrNullProvider')]
    public function testFailAsPositiveInteger(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param positive-int|null $expected
     */
    #[DataProvider('positiveIntegerOrNullProvider')]
    public function testAsPositiveIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asPositiveIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('nonPositiveIntegerProvider')]
    public function testFailAsPositiveIntegerOrNull(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asPositiveIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-negative-int $expected
     */
    #[DataProvider('naturalIntegerProvider')]
    public function testAsNaturalInteger(mixed $raw, int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNaturalInteger());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('negativeIntegerOrNullProvider')]
    public function testFailAsNaturalInteger(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNaturalInteger();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-negative-int|null $expected
     */
    #[DataProvider('naturalIntegerOrNullProvider')]
    public function testAsNaturalIntegerOrNull(mixed $raw, ?int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNaturalIntegerOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('negativeIntegerProvider')]
    public function testFailAsNaturalIntegerOrNull(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNaturalIntegerOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('stringProvider')]
    public function testAsString(mixed $raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asString());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('stringOrNullProvider')]
    public function testAsStringOrNull(mixed $raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     */
    #[DataProvider('nonEmptyStringProvider')]
    public function testAsNonEmptyString(mixed $raw, string $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNonEmptyString());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('emptyStringOrNullProvider')]
    public function testFailAsNonEmptyString(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyString();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string|null $expected
     */
    #[DataProvider('nonEmptyStringOrNullProvider')]
    public function testAsNonEmptyStringOrNull(mixed $raw, ?string $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNonEmptyStringOrNull());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('emptyStringProvider')]
    public function testFailAsNonEmptyStringOrNull(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value($raw);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStringOrNull();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     * @psalm-param non-empty-string $expected
     */
    #[DataProvider('nonEmptyStringProvider')]
    public function testAsNonEmptyStrings(mixed $raw, string $expected): void
    {
        $value = new Value([$raw, $raw]);
        self::assertSame([$expected, $expected], $value->asNonEmptyStrings());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('emptyStringOrNullProvider')]
    public function testFailAsNonEmptyStrings(mixed $raw, mixed $_expected = null): void
    {
        $value = new Value([$raw, $raw]);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStrings();
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('numericProvider')]
    public function testAsNumeric(mixed $raw, float|int $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNumeric());
    }

    /**
     * @psalm-param string|string[]|bool|null $raw
     */
    #[DataProvider('numericOrNullProvider')]
    public function testAsNumericOrNull(mixed $raw, float|int|null $expected): void
    {
        $value = new Value($raw);
        self::assertSame($expected, $value->asNumericOrNull());
    }

    /**
     * @psalm-param class-string<\Throwable>|null $expectedException
     */
    #[DataProvider('dateTimeProvider')]
    public function testAsDateTimeImmutable(mixed $raw, ?string $expectedException, mixed $expected, ?string $format): void
    {
        $value = new Value($raw);

        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }

        $date = $value->asDateTimeImmutable($format);

        self::assertSame($expected, $date->format(DateTimeInterface::RSS));
    }

    public static function dateTimeProvider(): iterable
    {
        yield [null, InvalidArgumentException::class, null, null];
        yield [1234, InvalidArgumentException::class, null, null];
        yield ['blub', InvalidArgumentException::class, null, null];
        yield ['20221111', null, 'Fri, 11 Nov 2022 00:00:00 +0000', null];
        yield ['2022-11-11', null, 'Fri, 11 Nov 2022 00:00:00 +0000', null];
        yield ['2022-11-11T05:06:07+01:00', null, 'Fri, 11 Nov 2022 05:06:07 +0100', null];
        yield ['2022-11-11', InvalidArgumentException::class, null, DateTimeInterface::ATOM];
        yield ['2022-11-11T03:04:02+00:00', null, 'Fri, 11 Nov 2022 03:04:02 +0000', DateTimeInterface::ATOM];
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
     *     1: non-negative-int,
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

    public static function numericOrNullProvider(): iterable
    {
        yield from self::numericProvider();
        yield from self::nullProvider();
    }

    /**
     * @psalm-return iterable<array{
     *     0: non-empty-string,
     *     1: float|int,
     * }>
     */
    public static function numericProvider(): iterable
    {
        yield ['1', 1];
        yield ['1.1', 1.1];
        yield ['0', 0];
        yield ['-1', -1];
        yield ['-1.1', -1.1];
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
