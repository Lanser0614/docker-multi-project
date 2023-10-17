<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$rules = [
    '@PSR12:risky' => true,
    'ordered_imports' => ['sort_algorithm' => 'length', 'imports_order' => ['const', 'function', 'class']],
    'declare_strict_types' => false,
    'no_unused_imports' => true,
    'whitespace_after_comma_in_array' => true,
    'cast_spaces' => true,
    'include' => true,
    'single_quote' => true,
    'space_after_semicolon' => true,
    'standardize_not_equals' => true,
    'trailing_comma_in_multiline' => true,
    'trim_array_spaces' => true,
    'unary_operator_spaces' => true,
    'psr_autoloading' => true,
    'array_syntax' => ['syntax' => 'short'],
    'concat_space' => ['spacing' => 'one'],
    'native_function_casing' => true,
    'no_spaces_around_offset' => true,
    'single_line_comment_style' => [
        'comment_types' => ['hash'],
    ],
    'self_accessor' => false,
    'magic_method_casing' => true,
    'magic_constant_casing' => true,
    'no_singleline_whitespace_before_semicolons' => true,
    'no_useless_return' => true,
    'no_whitespace_before_comma_in_array' => true,
    'normalize_index_brace' => true,
    'not_operator_with_successor_space' => false,
    'object_operator_without_whitespace' => true,
    'no_short_bool_cast' => true,
    'no_empty_statement' => true,
    'no_leading_namespace_whitespace' => true,
    'binary_operator_spaces' => [
        'default' => 'single_space',
        'operators' => ['=>' => null],
    ],
    'blank_line_before_statement' => [
        'statements' => ['return'],
    ],
    'no_unneeded_control_parentheses' => true,
    'class_attributes_separation' => [
        'elements' => ['method' => 'one'],
    ],
    'fully_qualified_strict_types' => true,
    'function_typehint_space' => true,
    'increment_style' => ['style' => 'post'],
    'linebreak_after_opening_tag' => true,
    'no_extra_blank_lines' => [
        'tokens' => [
            'extra',
            'throw',
            'use',
        ],
    ],
    'no_multiline_whitespace_around_double_arrow' => true,
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line',
    ],

    'no_blank_lines_after_phpdoc' => true,
    'no_empty_phpdoc' => true,
    'phpdoc_indent' => true,
    'general_phpdoc_tag_rename' => true,
    'phpdoc_inline_tag_normalizer' => true,
    'phpdoc_tag_type' => true,
    'phpdoc_no_access' => true,
    'phpdoc_no_package' => true,
    'phpdoc_no_useless_inheritdoc' => true,
    'phpdoc_scalar' => true,
    'phpdoc_single_line_var_spacing' => true,
    'phpdoc_summary' => true,
    'phpdoc_trim' => true,
    'phpdoc_types' => true,
    'phpdoc_var_without_name' => true,
    'braces' => [
        'allow_single_line_closure' => true,
        'position_after_functions_and_oop_constructs' => 'same',
        'position_after_control_structures' => 'same',
    ],
    'nullable_type_declaration_for_default_null_value' => [
        'use_nullable_type_declaration' => false
    ],

];

$finder = Finder::create()
    ->in([
        '/var/www/app',
//        '/var/www/config',
//        '/var/www/database',
//        '/var/www/resources',
//        '/var/www/routes',
//        '/var/www/tests',
    ])
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new Config();

return $config->setFinder($finder)
    ->setRules($rules)
    ->setRiskyAllowed(true)
    ->setUsingCache(true)
    ->setCacheFile('/var/www/.php-cs-fixer.cache');
