#!/usr/bin/php
<?php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

require_once('dbConnection.php');
require_once('dmzFunctions.php');

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
    //Restaurant Reccomendation********************************************************************************************
    case "Yelp":
      echo "\n*Type: Restaurant Reccomendation\n";
      $response_msg =  doYelp($request['username'],$request['term'],$request['location'],$request['radius']);
      break;
    //Set Date********************************************************************************************
    case "Date":
      echo "\n*Type: Set Date\n";
      $response_msg = doDate($request['username'],$request['search'],$request['cuisine'],$request['diet'],$request['restrictions'],$request['type'],$request['calories'],$request['location']);
      break;
    //Spoonacular*************************************************************************************
    case "Search":
      echo "\n*Type: Search Food\n";
      $response_msg = doSearch($request['username'],$request['search']);
      break;
    //Food*************************************************************************************
    case "Food":
      echo "\n*Type: Food Reccomendation\n";
      $response_msg = doFood($request['username'],$request['search'],$request['cuisine'],$request['diet'],$request['restrictions'],$request['type'],$request['calories']);
      break;
  //return array("returnCode" => '0', 'message'=>"Server received request and processed");
  echo $response_msg;
  return $response_msg;
  }
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "dmzMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "dmzServer END".PHP_EOL;
exit();
?>
