<?php



use Contao\DataContainer;
use Contao\DC_Table;

/* Extend the tl_user palettes */
foreach ($GLOBALS['TL_DCA']['tl_member']['palettes'] as $k => $v) {
  $GLOBALS['TL_DCA']['tl_member']['palettes'][$k] = str_replace('groups;', 'groups;{contao_likes_legend}, likes;', $v);
}

/* Add fields to tl_user */
$GLOBALS['TL_DCA']['tl_member']['fields']['likes'] = array
(
    'label'            => &$GLOBALS['TL_LANG']['tl_member_group']['likes'],
    'inputType'        => 'checkboxWizard',
    'eval'             => array('multiple'=> true, 'mandatory'=>false, 'tl_class'=>'long'),
    'flag'             => DataContainer::SORT_ASC,
    'options_callback' => array('Bcs\Backend\LikesBackend', 'getLikes'),
    'save_callback' => array
    (
        array('Bcs\Backend\LikesBackend', 'saveCallback')
    ),
    'sql'              => "blob NULL"
);
