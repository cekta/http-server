<?php

declare(strict_types=1);

use NunoMaduro\PhpInsights\Domain\Insights\CyclomaticComplexityIsHigh;
use NunoMaduro\PhpInsights\Domain\Insights\ForbiddenNormalClasses;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff;
use SlevomatCodingStandard\Sniffs\Classes\SuperfluousInterfaceNamingSniff;

return [
    'preset' => 'default',
    'exclude' => [
    ],
    'add' => [
    ],
    'remove' => [
        ForbiddenNormalClasses::class,
        SuperfluousInterfaceNamingSniff::class,
    ],
    'config' => [
        LineLengthSniff::class => [
            'lineLimit' => 120,
            'absoluteLineLimit' => 0,
            'ignoreComments' => false,
        ],
        CyclomaticComplexityIsHigh::class => [
            'maxComplexity' => 10,
        ],
    ],
];
