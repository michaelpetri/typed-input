<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use InvalidArgumentException;
use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{

    public function testAsNonEmptyString(): void
    {
        $raw = 'non-empty-string';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyString());

        $raw = ' ';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyString());
    }

    public function testFailAsNonEmptyString(): void
    {
        $value = new Value('');
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyString();
    }

    public function testAsNonEmptyStringOrNull(): void
    {
        $raw = 'non-empty-string';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyStringOrNull());

        $raw = ' ';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyStringOrNull());

        $raw = null;
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyStringOrNull());
    }

    public function testFailAsNonEmptyStringOrNull(): void
    {
        $value = new Value('');
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStringOrNull();
    }

    public function testAsNonEmptyStrings(): void
    {
        $raws = ['non-empty-string-1', 'non-empty-string-2'];
        $value = new Value($raws);
        self::assertEquals($raws, $value->asNonEmptyStrings());
    }

    public function testFailAsNonEmptyStrings(): void
    {
        $value = new Value(['non-empty-string', '']);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStrings();
    }

    public function testAsString(): void
    {
        $raw = '';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asString());

        $raw = 'non-empty-string';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asString());

        $raw = 1;
        $value = new Value($raw);
        self::assertEquals((string) $raw, $value->asString());
    }

    public function testAsInteger(): void
    {
        $raw = 1;
        $value = new Value($raw);
        self::assertEquals($raw, $value->asInteger());
    }
}
