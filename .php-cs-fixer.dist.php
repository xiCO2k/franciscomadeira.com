<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->in([
        __DIR__.'/',
    ])
    ->notPath('bootstrap/*')
    ->notPath('storage/*')
    ->notPath('vendor/*')
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$rules = [
    '@Symfony'               => true,
    'phpdoc_no_empty_return' => false,
    'phpdoc_types_order'     => false,
    'phpdoc_to_comment'      => false,
    'array_syntax'           => ['syntax' => 'short'],
    'yoda_style'             => false,
    'concat_space'            => ['spacing' => 'one'],
    'not_operator_with_space' => false,
];

$rules['increment_style'] = ['style' => 'post'];

return (new PhpCsFixer\Config())
    ->setUsingCache(true)
    ->setRules($rules)
    ->setFinder($finder);
