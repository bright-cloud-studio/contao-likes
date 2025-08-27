<?php

use Contao\Config;

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{contao_likes_legend}, contao_likes_icon;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'contao_likes_icon' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['contao_likes_icon'],
        'inputType'         => 'text',
        'default'           => '<i class="fas fa-heart"></i>',
        'eval'              => ['mandatory' => 'true', 'allowHtml' => true, 'tl_class' => 'w50'],
    ]
];
