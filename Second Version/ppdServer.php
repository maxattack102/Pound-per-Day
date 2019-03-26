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
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    //Login******************************************************************************************************************************
    case "Login":
      echo "\n*Type: Login\n";
      return doLogin($request['username'],$request['password']);
    //Register***************************************************************************************************************************
    case "Register":
      echo "\n*Type: Registration\n";
      return doRegister($request['username'],$request['email'],$request['password_1'],$request['password_2']);
    //Profile****************************************************************************************************************************
    case "Profile":
      echo "\nType: Profile\n";
      return doProfile($request['username'],$request['fname'],$request['lname'],$request['age'],$request['weight'],$request['height_ft'],$request['height_in'],$request['gender'],$request['loss'],$request['activity']);
    //Search*****************************************************************************************************************************
    case "Search":
      echo "\n*Type: Search\n";
      return searchFood($request['username'],$request['search'],$request['course']);
    //Validate***************************************************************************************************************************
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>