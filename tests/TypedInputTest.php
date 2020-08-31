<?php

declare(strict_types=1);

namespace MichaelPetri\TypedInput\Tests;

use MichaelPetri\TypedInput\TypedInput;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;

final class TypedInputTest extends TestCase
{
    public function testGetOption(): void
    {
        $definition = new InputDefinition();
        $definition->addOption(new InputOption(
            'my-option',
            null,
            InputOption::VALUE_REQUIRED,
            'My option which is an non-empty-string',
            'my-default-value'
        ));

        $input = new ArrayInput(['--my-option' => 'my-value'], $definition);

        $typedInput = TypedInput::fromInput($input);
        self::assertEquals('my-value', $typedInput->getOption('my-option')->asNonEmptyString());
    }

    public function testGetArgument(): void
    {
        $definition = new InputDefinition();
        $definition->addArgument(new InputArgument(
            'my-argument',
            InputArgument::OPTIONAL,
            'My option which is an non-empty-string',
            'my-default-value'
        ));

        $input = new ArrayInput(['my-argument' => 'my-value'], $definition);

        $typedInput = TypedInput::fromInput($input);
        self::assertEquals('my-value', $typedInput->getArgument('my-argument')->asNonEmptyString());
    }
}