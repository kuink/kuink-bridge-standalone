<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('vendor')
    ->in('src')
    ->in('public')
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setFinder($finder)
;