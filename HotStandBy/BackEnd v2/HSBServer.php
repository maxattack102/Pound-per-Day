#!/usr/bin/php
<?php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

require_once('dbConnection.php');
require_once('dBfunctions.php');

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/rabbitmq/error_log/log.txt');

function requestProcessor($request)
{
  echo "\n\n\nreceived request".PHP_EOL;
  echo $request['type'].PHP_EOL;
  var_dump($request);

  if(!isset($request['type']))
  {
    //return "ERROR: unsupported message type";
    return array('message'=>"ERROR: unsupported message type");
  }
  switch ($request['type'])
  {
    //Login**********************************************************************************************
    case "Login":
      echo "\n*Type: Login\n";
      $response_msg = doLogin($request['username'],$request['password']);
      break;
    //ViewInfo
    case "ViewInfo";
      echo "\n*Type: View Info\n";
      $response_msg = show($request['username']);
      break;
    //Register*******************************************************************************************
    case "Register":
      echo "\n*Type: Registration\n";
      $response_msg = doRegister($request['username'],$request['email'],$request['password_1'],$request['password_2']);
      break;
    //Profile********************************************************************************************
    case "Profile":
      echo "\n*Type: Profile\n";
      $response_msg = doProfile($request['username'],$request['fname'],$request['lname'],$request['age'],$request['weight'],$request['height_ft'],$request['height_in'],$request['gender'],$request['loss'],$request['activity']);
      break;
   //Register********************************************************************************************
    case "Preferences":
      echo "\n*Type: Preferences\n";
      $response_msg = doPref($request['username'],$request['cuisine'],$request['diet'],$request['restrictions']);
      break;
    //Profile-Update*************************************************************************************
    case "Update":
      echo "\n*Type: Update Profile\n";
      $response_msg = doUpdate($request['username'],$request['fname'],$request['lname'],$request['age'],$request['weight'],$request['height_ft'],$request['height_in'],$request['gender'],$request['loss'],$request['activity']);
      break;
      //Pref-Update**************************************************************************************
    case "Update Pref":
      echo "\n*Type: Update Profile\n";
      $response_msg = doUpdatePref($request['username'],$request['cuisine'],$request['diet'],$request['restrictions']);
      break;
    //Search**********************************************************************************************
    case "Search":
      echo "\n*Type: Search\n";
      $response_msg = searchFood($request['username'],$request['search'],$request['course']);
      break;
    //Rating**********************************************************************************************
    case "Rating":
      echo "\n*Type: Rating\n";
      $response_msg = doRating($request['username'],$request['selectType'],$request['foodName'],$request['rating'],$request['recommend'],$request['comments']);
      break;
    //Validate********************************************************************************************
    case "validate_session":
      $response_msg = doValidate($request['sessionId']);
      break;
  }
  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
  echo $response_msg;
  //$fullname = json_decode($response_msg);
  //echo $fullname->{'lname'};
  return $response_msg;
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "Hot StandBy ppdRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "Hot StandBy ppdRabbitMQServer END".PHP_EOL;
exit();
?>
