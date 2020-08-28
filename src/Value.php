<?php

namespace MichaelPetri\TypedInput;

use Webmozart\Assert\Assert;

final class Value
{
    /**
     * @var string|int|float|string[]|int[]|float[]
     */
    private $value;

    /**
     * @param string|int|float|string[]|int[]|float[] $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function asInteger(): int
    {
        $value = (int) $this->value;
        Assert::integer($value);

        return $value;
    }

    /**
     * @psalm-return list<non-empty-string>
     * @return string[]
     */
    public function asNonEmptyStrings(): array
    {
        $values = array_map(
            static function ($value): string {
                return (string) $value;
            },
            $this->value
        );
        Assert::allStringNotEmpty($values);

        return array_values($values);
    }


    /** @psalm-return non-empty-string */
    public function asNonEmptyString(): string
    {
        $value = (string) $this->value;
        Assert::stringNotEmpty($value);

        return $value;
    }

    /** @psalm-return non-empty-string|null */
    public function asNonEmptyStringOrNull(): ?string
    {
        $value = null !== $this->value ? (string) $this->value : null;
        Assert::nullOrStringNotEmpty($value);

        return $value;
    }

    public function asString(): string
    {
        $value = (string) $this->value;
        Assert::string($value);

        return $value;
    }
}