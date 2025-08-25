<?php

   /* Extend the tl_user palettes */
  foreach ($GLOBALS['TL_DCA']['tl_member']['palettes'] as $k => $v) {
      $GLOBALS['TL_DCA']['tl_member']['palettes'][$k] = str_replace('groups;', 'groups;{price_tier_legend}, price_tier, price_tier_display;{admin_review_legend}, last_reviewed; {last_review_and_submit_legend}, last_review_and_submit;', $v);
  }

  /* Add fields to tl_user */
  $GLOBALS['TL_DCA']['tl_member']['fields']['price_tier'] = array
  (
    'label'                   => &$GLOBALS['TL_LANG']['tl_member']['price_tier'],
    'inputType'               => 'select',
    'flag'                    => DataContainer::SORT_ASC,
    'eval'                    => array('mandatory'=>true, 'multiple'=>false, 'tl_class'=>'', 'submitOnChange'=>false),
    'options_callback'	      => array('Bcs\Backend\ServiceBackend', 'getPriceTiers'),
    'sql'                     => "varchar(50) NOT NULL default ''",
    'default'                 => "tier_1_price"
  );
