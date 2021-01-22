# Typed Input

[![Type Coverage](https://shepherd.dev/github/michaelpetri/typed-input/coverage.svg)](https://shepherd.dev/github/michaelpetri/typed-input)
[![Latest Stable Version](https://poser.pugx.org/michaelpetri/typed-input/v)](//packagist.org/packages/michaelpetri/typed-input)
[![License](https://poser.pugx.org/michaelpetri/typed-input/license)](//packagist.org/packages/michaelpetri/typed-input)

## Installation:
```
composer require michaelpetri/typed-input 
```

## Usage:
```php
$typedInput = TypedInput::fromInput($input);

echo $typedInput->getOption('my-option')->asNonEmptyString();
echo $typedInput->getArgument('my-argument')->asInteger();
```

## Available methods:

See [michaelpetri/typed-input](https://github.com/michaelpetri/typed-value/tree/1.x) for a list of available methods.