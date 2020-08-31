<?php

namespace MichaelPetri\TypedInput;

use Webmozart\Assert\Assert;

/**
 * @psalm-immutable
 */
final class Value
{
    /** @var string|string[]|bool|null */
    private $value;

    /**
     * @param string|string[]|bool|null $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @psalm-pure
     */
    public function asBoolean(): bool
    {
        $value = $this->asBooleanOrNull();
        Assert::notNull($value);

        return $value;
    }

    /**
     * @psalm-pure
     */
    public function asBooleanOrNull(): ?bool
    {
        $value = $this->value;
        Assert::nullOrBoolean($value);

        return $value;
    }

    /**
     * @psalm-pure
     */
    public function asInteger(): int
    {
        $value = $this->asIntegerOrNull();
        Assert::notNull($value);

        return $value;
    }

    /**
     * @psalm-pure
     */
    public function asIntegerOrNull(): ?int
    {
        $value = $this->value;
        Assert::nullOrIntegerish($value);

        return null !== $value
            ? (int) $value
            : null;
    }

    /**
     * @psalm-pure
     *
     * @psalm-return positive-int
     */
    public function asPositiveInteger(): int
    {
        $value = $this->asPositiveIntegerOrNull();
        Assert::notNull($value);

        return $value;
    }

    /**
     * @psalm-pure
     *
     * @psalm-return positive-int|null
     * @psalm-suppress MoreSpecificReturnType
     */
    public function asPositiveIntegerOrNull(): ?int
    {
        $value = $this->asIntegerOrNull();
        Assert::nullOrGreaterThan($value, 0);

        /** @psalm-suppress LessSpecificReturnStatement */
        return $value;
    }

    /**
     * @psalm-pure
     */
    public function asString(): string
    {
        $value = $this->asStringOrNull();
        Assert::string($value);

        return $value;
    }

    /**
     * @psalm-pure
     */
    public function asStringOrNull(): ?string
    {
        $value = $this->value;

        if (is_numeric($value)) {
            $value = (string) $value;
        }

        Assert::nullOrString($value);

        return $value;
    }

    /**
     * @psalm-pure
     *
     * @psalm-return non-empty-string
     */
    public function asNonEmptyString(): string
    {
        $value = $this->asNonEmptyStringOrNull();
        Assert::notNull($value);

        return $value;
    }

    /**
     * @psalm-pure
     * @psalm-return non-empty-string|null
     */
    public function asNonEmptyStringOrNull(): ?string
    {
        $value = $this->value;

        if (is_numeric($value)) {
            $value = (string) $value;
        }

        Assert::nullOrStringNotEmpty($value);

        return $value;
    }

    /**
     * @psalm-pure
     *
     * @psalm-return list<non-empty-string>
     * @return string[]
     */
    public function asNonEmptyStrings(): array
    {
        $values = $this->value;

        Assert::isArray($values);

        $values = array_map(
            static function ($value) {
                return is_numeric($value) ? (string) $value : $value;
            },
            $values
        );

        Assert::allStringNotEmpty($values);

        return array_values($values);
    }
}
