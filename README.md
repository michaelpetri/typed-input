# Typed Input

Installation:
```
composer require michaelpetri/typed-input 
```

Usage:
```
$typedInput = TypedInput::fromInput($input);

echo $typedInput->getOption('my-option')->asNonEmptyString();
echo $typedInput->getArgument('my-argument')->asInteger();
```