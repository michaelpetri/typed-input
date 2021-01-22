<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput;

use MichaelPetri\TypedValue\TypedValue;

/**
 * @psalm-immutable
 * @deprecated will be removed with version 2.0.0, please use TypedValue instead
 */
final class Value
{
    private TypedValue $value;

    /** @param string|string[]|bool|null $value */
    public function __construct($value)
    {
        $this->value = TypedValue::create($value);
    }

    public function asBoolean(): bool
    {
        return $this->value->asBoolean();
    }

    public function asBooleanOrNull(): ?bool
    {
        return $this->value->asBooleanOrNull();
    }

    public function asInteger(): int
    {
        return $this->value->asInteger();
    }

    public function asIntegerOrNull(): ?int
    {
        return $this->value->asIntegerOrNull();
    }

    /** @psalm-return positive-int */
    public function asPositiveInteger(): int
    {
        return $this->value->asPositiveInteger();
    }

    /**
     * @psalm-return positive-int|null
     * @psalm-suppress MoreSpecificReturnType
     */
    public function asPositiveIntegerOrNull(): ?int
    {
        return $this->value->asPositiveIntegerOrNull();
    }

    /**
     * @psalm-return positive-int|0
     * @psalm-suppress MoreSpecificReturnType
     */
    public function asNaturalInteger(): int {
        return $this->value->asNaturalInteger();
    }

    /**
     * @psalm-return positive-int|0|null
     * @psalm-suppress LessSpecificReturnStatement
     * @psalm-suppress MoreSpecificReturnType
     */
    public function asNaturalIntegerOrNull(): ?int {
        return $this->value->asNaturalIntegerOrNull();
    }

    public function asString(): string
    {
        return $this->value->asString();
    }

    public function asStringOrNull(): ?string
    {
        return $this->value->asStringOrNull();
    }

    /** @psalm-return non-empty-string */
    public function asNonEmptyString(): string
    {
        return $this->value->asNonEmptyString();
    }

    /** @psalm-return non-empty-string|null */
    public function asNonEmptyStringOrNull(): ?string
    {
        return $this->value->asNonEmptyStringOrNull();
    }

    /**
     * @psalm-return list<non-empty-string>
     * @return string[]
     */
    public function asNonEmptyStrings(): array
    {
        return $this->value->asNonEmptyStrings();
    }
}
