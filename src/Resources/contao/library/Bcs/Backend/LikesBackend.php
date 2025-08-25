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
                    
                    return '<a style="display: none;" class="contao_like">' . $member->id . ' LIKES GALLERY ' .$arrTag[1] . '</a>';
                    
                break;
            }
            
            return 'Error with processInsertTags function';
            
        }
    }


    public function saveCallback($varValue, DataContainer $dc) {
        
        // Get the Test IDs
        $group_ids = unserialize($varValue);

        // Foreach Test
        foreach($group_ids as $id) {
            
            // Get any Test Results that are assigned to this Test
            $test_results = TestResult::findBy(['test = ?'], [$id]);
            if($test_results) {
                foreach($test_results as $test_result) {
                    
                    // Get any current Member Group values as an array
                    $mem_groups = unserialize($test_result->member_groups);
                    // Add our current Member Group to the list of selected Member Groups
                    $mem_groups[] = $dc->activeRecord->id;
                    // Save our changes
                    $test_result->member_groups = serialize($mem_groups);
                    $test_result->save();
                }
            }
            
        }

        return $varValue;
    }


    
    // Get Members as options for a Select DCA field
    public function getTests(DataContainer $dc) {
        $tests = array();
        $this->import('Database');
        $result = $this->Database->prepare("SELECT * FROM tl_form WHERE formType='test' ORDER BY title ASC")->execute();
        while($result->next())
        {
            $tests = $tests + array($result->id => $result->title . '[' . $result->id . ']');   
        }
        return $tests;
    }
    
    
}
