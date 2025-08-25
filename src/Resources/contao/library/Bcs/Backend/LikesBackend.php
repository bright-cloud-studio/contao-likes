<?php

namespace Bcs\Backend;

use Contao\Backend;
use Contao\Image;
use Contao\Input;
use Contao\DataContainer;
use Contao\StringUtil;

class LikesBackend extends Backend
{
  
    public function processInsertTags (string $insertTag)
    {
        // if this tag doesnt contain :: it doesn't have an id, so we can stop right here
        if (stristr($insertTag, "::") === FALSE) {
            return 'No ID given';
        }
        
        // break our tag into an array
        $arrTag = explode("::", $insertTag);
        
        // lets make decisions based on the beginning of the tag
        switch($arrTag[0]) {
            // if the tag is what we want, {{simple_inventory::id}}, then lets go
            case 'test':
                //$arrTag[1];
                return "Test Successful!";
            break;
        }
        
        return 'Error with processInsertTags function';
    }
    
}
