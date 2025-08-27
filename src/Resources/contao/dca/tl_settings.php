<?php

use Contao\Config;

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{contao_likes_legend}, icon;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']);

$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'icon' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['icon'],
        'inputType'         => 'text',
        'default'           => '<i class="fas fa-heart"></i>',
        'eval'              => ['mandatory' => 'true', 'tl_class' => 'w50'],
    ]
];
