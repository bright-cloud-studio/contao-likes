<?php

namespace Bcs\Backend;

use Contao\Backend;
use Contao\Database;
use Contao\Config;
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
                    
                    $this_user_liked = false;
                    $counter = 0;
                    $this->import('Database');
		            $result = $this->Database->prepare("SELECT * FROM tl_member WHERE likes LIKE '%".$arrTag[1]."%'")->execute();
		            while($result->next()) {
		                $counter++;
		                
		                if($result->id == $member->id)
		                    $this_user_liked = true;
		                
		            }
		           
                    
                    if($this_user_liked)
                        return '<a style="" class="contao_like contao_like_'.$arrTag[1].' liked_by_user" data-uid="'.$arrTag[1].'" data-member="'.$member->id.'">' . Config::get('contao_likes_icon'). '(<span id="like_total_'.$arrTag[1].'">'.$counter.'</span>)</a>';
                    else
                        return '<a style="" class="contao_like contao_like_'.$arrTag[1].'" data-uid="'.$arrTag[1].'" data-member="'.$member->id.'">' . Config::get('contao_likes_icon'). '(<span id="like_total_'.$arrTag[1].'">'.$counter.'</span>)</a>';
                    
                break;
            }
            
            return 'Error with processInsertTags function';
            
        }
    }


    public function saveCallback($varValue, DataContainer $dc) {
        return $varValue;
    }


    
    // Get Members as options for a Select DCA field
    public function getLikes(DataContainer $dc) {
    }
    
    
}
