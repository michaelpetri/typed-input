<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput;

use DateTimeImmutable;

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
final class Value
{
    public function __construct(private readonly mixed $value)
    {
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asBoolean(): bool
    {
        return bool()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asBooleanOrNull(): ?bool
    {
        return nullable(bool())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asInteger(): int
    {
        return int()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asIntegerOrNull(): ?int
    {
        return nullable(int())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return positive-int
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asPositiveInteger(): int
    {
        return positive_int()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return positive-int|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asPositiveIntegerOrNull(): ?int
    {
        return nullable(positive_int())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return positive-int|0
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNaturalInteger(): int
    {
        return uint()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return positive-int|0|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNaturalIntegerOrNull(): ?int
    {
        return nullable(uint())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asString(): string
    {
        return string()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asStringOrNull(): ?string
    {
        return nullable(string())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return non-empty-string
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNonEmptyString(): string
    {
        return non_empty_string()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return non-empty-string|null
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNonEmptyStringOrNull(): ?string
    {
        return nullable(non_empty_string())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-return list<non-empty-string>
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     *
     */
    public function asNonEmptyStrings(): array
    {
        return vec(non_empty_string())->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNumeric(): float|int
    {
        return num()->coerce(
            $this->value
        );
    }

    /**
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asNumericOrNull(): float|int|null
    {
        return nullable(num())->coerce(
            $this->value
        );
    }

    /**
     * @param non-empty-string $format
     * @psalm-suppress ImpureFunctionCall because we know PSL Type is pure
     * @psalm-suppress ImpureMethodCall because we know PSL Type is pure
     */
    public function asDateTimeImmutable(string $format): DateTimeImmutable
    {
        $value = $this->asString();

        return instance_of(\DateTimeImmutable::class)->coerce(
            DateTimeImmutable::createFromFormat($format, $value)
        );
    }
}
