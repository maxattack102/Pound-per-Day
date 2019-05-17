#!/usr/bin/php
<?php
session_start(); 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/Logs/dmzLog.txt'); 

$username = "";
$errors = array();

$client = new rabbitMQClient("test2RabbitMQ.ini","testServer");
echo "ppdClient BEGIN".PHP_EOL;

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
//MAXIM*****************************

//FOOD-SEARCH
if (isset($_POST['food_search'])) {
	$request = array();
	$request['type']       = "Search";
	$request['username']   = $_SESSION["username"];
	$request['search']     = $_POST["search"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_decode($response);
		header('location: template.php');	
	}
}

//YELP RECCOMENDATION
if (isset($_POST['yelp_reccomendation'])) {
	$request = array();
	$request['type']     	= "Yelp";
	$request['username'] 	= $_SESSION["username"];
	$request['mile']   	= $_POST["mile"];
	$request['search'] 	= $_POST["search"];
	$request['location']   	= $_POST["location"];
	$request['categories']  = $_POST["categories"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_decode($response);
		header('location: template.php');	
	}
}

//Food Reccomendation
if (isset($_POST['food_reccomendation'])) {
	$request = array();
	$request['type']     	= "Search";
	$request['username'] 	= $_SESSION["username"];
	$request['search']   	= $_POST["search"];
	$request['cuisine']   	= $_POST["cuisine"];
	$request['diet']   	= $_POST["diet"];
	$request['restrictions']= $_POST["restrictions"];
	$request['foodType']   	= $_POST["foodType"];
	$request['calories']   	= $_POST["calories"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_decode($response);
		header('location: template.php');	
	}
}

echo "ppdClient END".PHP_EOL;
?>

