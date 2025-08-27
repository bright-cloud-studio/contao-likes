<?php
    
    // Start PHP session and include Composer, which also brings in our Google Sheets PHP stuffs
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
    
    // Load our database connection information from a txt file on the root of the server, for safety
    $serializedData = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../db.txt');
    $db_info = unserialize($serializedData);
    
    // Connect to database using our privately hidden information
    $dbh = new mysqli("localhost", $db_info[0], $db_info[1], $db_info[2]);
    if ($dbh->connect_error) {
        die("Connection failed: " . $dbh->connect_error);
    }
    
    $myfile = fopen("logs/action_like_".date('m_d_Y_hia').".txt", "w") or die("Unable to open file!");
    
    // Get data from ajax
    $uid = $_POST['uid'];
    $member_id = $_POST['member_id'];
    fwrite($myfile, "Unique ID: " . $uid . "\r\n");
    fwrite($myfile, "Member ID: " . $member_id . "\r\n");
    
    
    // Get the Member using the ID
    $member_query =  "SELECT * FROM tl_member WHERE id='".$member_id."'";
    $member_db = $dbh->query($member_query);
    if($member_db) {
        while($member = $member_db->fetch_assoc()) {
            
            if($member['likes'] != null) {
                $likes = unserialize($member['likes']);
                
                if (!in_array($uid, $likes)) {
                    $likes[] = $uid;
                    $likes = serialize($likes);
                    
                    $update_query =  "UPDATE tl_member SET likes='$likes'WHERE id='$member_id'";
                    $update_db = $dbh->query($update_query);
                    
                    fwrite($myfile, "Update: " . $member_id . "\r\n");
                }

                
                
            } else {
                $likes[] = $uid;
                $likes = serialize($likes);
                
                $update_query =  "UPDATE tl_member SET likes='$likes'WHERE id='$member_id'";
                $update_db = $dbh->query($update_query);
                
                fwrite($myfile, "Update on NULL: " . $member_id . "\r\n");
                
            }
            
        }
    }

    
    
    fclose($myfile);
    echo "Success!";
