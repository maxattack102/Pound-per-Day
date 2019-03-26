<?php

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitMQClient.php');
require_once('dbConnection.php');
    //Error logging
    error_reporting(E_ALL);
    ini_set('display_errors', 'off');
    ini_set('log_errors', 'On');

function show($username, &$output)
{
   
    $connection = dbConnection();
    
    $output = "";
    
    $showSql = "SELECT * FROM `accounts` WHERE username='$username'";
    $result = $connection->query($showSql);
    
    while ( $r = $result->fetch_assoc() ) 
    {
       $username   = $r[ "username" ];
       $fname      = $r[ "fname" ];
       $lname      = $r[ "lname" ];
       $age 	   = $r[ "age" ];
       $weight     = $r[ "weight" ];
       $height_ft  = $r[ "height_ft" ];
       $height_in  = $r[ "height_in"]; 
       $gender 	   = $r[ "gender" ];
       $activity   = $r[ "activity" ];
       $email	   = $r[ "email" ];
       //echo
       $output .= "<strong>User:</strong> $username<br>";
       $output .= "<strong>Age:</strong> $age<br>";
       $output .= "<strong>Weight:</strong> $weight<br>";
       $output .= "<strong>Height:</strong> $height_ft ft. $height_in in.<br>";
       $output .= "<strong>Gender:</strong> $gender<br>";
       $output .= "<strong>Activity:</strong> $activity<br>";
       $output .= "<strong>Email:</strong> $email<br><br>"; 
    };

    echo $output;
    return true;
}

function fullName($username, &$output)
{
    $connection = dbConnection();
    
    $output = "";
    
    $fullNsql = "SELECT * FROM `accounts` WHERE username='$username'";
    $result = $connection->query($fulNsql);
    
    while ( $r = $result->fetch_assoc() ) 
    {
       $username   = $r[ "username" ];
       $fname      = $r[ "fname" ];
       $lname      = $r[ "lname" ];
       $output .= "<strong>$fname $lname</strong>";
    }; 
    echo $output;
    return true;
}

?>
