<?php

namespace Bcs\Backend;

use Contao\Backend;
use Contao\Image;
use Contao\Input;
use Contao\DataContainer;
use Contao\StringUtil;

use Contao\FrontendUser;

class LikesBackend extends Backend
{
  
    public function processInsertTags (string $insertTag)
    {
        // if this tag doesnt contain :: it doesn't have an id, so we can stop right here
        if (stristr($insertTag, "::") === FALSE) {
            return 'No ID given';
        }
        
        // Try to get the Member and check if it exists
        $member = FrontendUser::getInstance();
        if($member) {
                
            $arrTag = explode("::", $insertTag);
            switch($arrTag[0]) {
                case 'contao_likes':
                    
                    return '<!-- USER ' . $member->id . ' LIKES GALLERY ' .$arrTag[1] . '-->';
                    
                break;
            }
            
            return 'Error with processInsertTags function';
            
        }
    }
    
}
