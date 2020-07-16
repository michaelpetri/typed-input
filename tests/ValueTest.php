<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use InvalidArgumentException;
use MichaelPetri\TypedInput\Value;
use PHPUnit\Framework\TestCase;

final class ValueTest extends TestCase
{

    public function testAsNonEmptyString()
    {
        $raw = 'non-empty-string';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyString());

        $raw = ' ';
        $value = new Value($raw);
        self::assertEquals($raw, $value->asNonEmptyString());
    }

    public function testFailAsNonEmptyString()
    {
        $value = new Value('');
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyString();
    }

    public function testAsNonEmptyStrings()
    {
        $raws = ['non-empty-string-1', 'non-empty-string-2'];
        $value = new Value($raws);
        self::assertEquals($raws, $value->asNonEmptyStrings());
    }

    public function testFailAsNonEmptyStrings()
    {
        $value = new Value(['non-empty-string', '']);
        $this->expectException(InvalidArgumentException::class);
        $value->asNonEmptyStrings();
    }

    public function testAsString()
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

    public function testAsInteger()
    {
        $raw = 1;
        $value = new Value($raw);
        self::assertEquals($raw, $value->asInteger());
    }
}
