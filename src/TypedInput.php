<?php

namespace MichaelPetri\TypedInput;

use Symfony\Component\Console\Input\InputInterface;

final class TypedInput
{
    /**
     * @var InputInterface
     */
    private $input;

    private function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    public static function fromInput(InputInterface $input): self
    {
        return new self($input);
    }

    public function getOption(string $name): Value
    {
        return new Value($this->input->getOption($name));
    }

    public function getArgument(string $name): Value
    {
        return new Value($this->input->getArgument($name));
    }
}