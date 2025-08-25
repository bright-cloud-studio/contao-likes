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
    $unique_id = $_POST['unique_id'];
    
    fwrite($myfile, "Unique ID: " . $unique_id . "\r\n");
    fclose($myfile);
    echo "success";
