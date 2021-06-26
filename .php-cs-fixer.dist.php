<?php

$finder = PhpCsFixer\Finder::create()
    ->in([__DIR__ . '/src', __DIR__ . '/tests']);

return (new PhpCsFixer\Config())
    ->setRules([
        'declare_strict_types' => true,
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_superfluous_phpdoc_tags' => ['allow_mixed' => true],
        'phpdoc_to_comment' => false,
    ])
    ->setFinder($finder);
