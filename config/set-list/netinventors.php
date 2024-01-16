<?php

use PhpCsFixer\Fixer\Basic\NoTrailingCommaInSinglelineFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\FunctionNotation\MethodArgumentSpaceFixer;
use PhpCsFixer\Fixer\Import\OrderedImportsFixer;
use PhpCsFixer\Fixer\Operator\BinaryOperatorSpacesFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $config): void {
    $config->sets([
        SetList::PSR_12,
        SetList::NAMESPACES,
        SetList::SPACES,
        SetList::STRICT,
    ]);

    $config->ruleWithConfiguration(
        OrderedImportsFixer::class,
        [
            'imports_order' => [
                OrderedImportsFixer::IMPORT_TYPE_CONST,
                OrderedImportsFixer::IMPORT_TYPE_CLASS,
                OrderedImportsFixer::IMPORT_TYPE_FUNCTION,
            ],
        ],
    );

    $config->rule(OrderedClassElementsFixer::class);
    $config->rule(YodaStyleFixer::class);

    $config->ruleWithConfiguration(
        BinaryOperatorSpacesFixer::class,
        [
            'operators' => [
                '='  => BinaryOperatorSpacesFixer::ALIGN_SINGLE_SPACE_MINIMAL,
                '=>' => BinaryOperatorSpacesFixer::ALIGN_SINGLE_SPACE_MINIMAL_BY_SCOPE,
            ],
        ],
    );

    $config->ruleWithConfiguration(
        MethodArgumentSpaceFixer::class,
        [
            'on_multiline' => 'ignore',
        ],
    );

    $config->rule(NoTrailingCommaInSinglelineFixer::class);

    $config->ruleWithConfiguration(
        TrailingCommaInMultilineFixer::class,
        [
            'elements' => [
                TrailingCommaInMultilineFixer::ELEMENTS_ARGUMENTS,
                TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS,
                TrailingCommaInMultilineFixer::ELEMENTS_PARAMETERS,
            ],
        ],
    );

    $config->skip([
        NotOperatorWithSuccessorSpaceFixer::class,
    ]);
};
