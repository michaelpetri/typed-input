<?php

namespace MichaelPetri\TypedInput;

use Webmozart\Assert\Assert;

final class Value
{
    private $value;

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
     * @return array<int, string>|string[]
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

        return $values;
    }

    public function asNonEmptyString(): string
    {
        $value = (string) $this->value;
        Assert::stringNotEmpty($value);

        return $value;
    }

    public function asString(): string
    {
        $value = (string) $this->value;
        Assert::string($value);

        return $value;
    }
}