<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput;

use DateTimeImmutable;
use InvalidArgumentException;
use Psl\Type\Exception\CoercionException;
use Throwable;

use function Psl\Type\bool;
use function Psl\Type\instance_of;
use function Psl\Type\int;
use function Psl\Type\non_empty_string;
use function Psl\Type\nullable;
use function Psl\Type\num;
use function Psl\Type\positive_int;
use function Psl\Type\string;
use function Psl\Type\uint;
use function Psl\Type\vec;

/** @psalm-immutable */
final readonly class Value
{
    public function __construct(private mixed $value)
    {
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asBoolean(): bool
    {
        try {
            return bool()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asBooleanOrNull(): ?bool
    {
        try {
            return nullable(bool())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asInteger(): int
    {
        try {
            return int()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asIntegerOrNull(): ?int
    {
        try {
            return nullable(int())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return positive-int
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asPositiveInteger(): int
    {
        try {
            return positive_int()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return positive-int|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asPositiveIntegerOrNull(): ?int
    {
        try {
            return nullable(positive_int())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return non-negative-int
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNaturalInteger(): int
    {
        try {
            return uint()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return non-negative-int|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNaturalIntegerOrNull(): ?int
    {
        try {
            return nullable(uint())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asString(): string
    {
        try {
            return string()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asStringOrNull(): ?string
    {
        try {
            return nullable(string())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return non-empty-string
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNonEmptyString(): string
    {
        try {
            return non_empty_string()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return non-empty-string|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNonEmptyStringOrNull(): ?string
    {
        try {
            return nullable(non_empty_string())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-return list<non-empty-string>
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     *
     */
    public function asNonEmptyStrings(): array
    {
        try {
            return vec(non_empty_string())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNumeric(): float|int
    {
        try {
            return num()->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNumericOrNull(): float|int|null
    {
        try {
            return nullable(num())->coerce(
                $this->value
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param non-empty-string|null $format
     * @throws InvalidArgumentException
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asDateTimeImmutable(?string $format = null): DateTimeImmutable
    {
        try {
            $value = $this->asString();

            if (null === $format && \is_numeric($value) && \strlen($value) < 8) {
                throw new InvalidArgumentException('Numeric strings are not supported as dates without a format.');
            }

            try {
                $dateTime = null !== $format
                    ? DateTimeImmutable::createFromFormat($format, $value)
                    : new DateTimeImmutable($value);
            } catch (Throwable $e) {
                throw new InvalidArgumentException($e->getMessage(), (int) $e->getCode(), $e);
            }

            if (false === $dateTime) {
                throw new InvalidArgumentException('Failed to parse date string.');
            }

            return instance_of(DateTimeImmutable::class)->coerce(
                $dateTime
            );
        } catch (CoercionException $e) {
            throw new InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
