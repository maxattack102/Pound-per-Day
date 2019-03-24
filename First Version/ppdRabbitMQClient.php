#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

// initializing variables
$username = "";
$email    = "";
$errors = array();

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
if (isset($_GET['search_food'])) {
	$request = array();
	$request['type']     = "Search";
	$request['username'] = $_POST["username"];
	$request['search'] = $_POST["search"];
	$request['course']  = $_POST["course"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	
	if ($response!=" "){
		session_start();
		$_SESSION['response'] = $response;
		header('location: searchfood.php');	}

	echo "\n\n";
	echo $argv[0]." END".PHP_EOL;
}
}

if (isset($_POST['login_user'])) {
	$request = array();
	$request['type']     = "Login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message']  = $msg;

	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);


	if ($response==1){
		header('location: index.php');	}

	echo "\n\n";
	echo $argv[0]." END".PHP_EOL;
}

if (isset($_POST['reg_user'])) {
	$request = array();
	$request['type']       = "Register";
	$request['username']   = $_POST["username"];
    $request['email']      = $_POST["email"];
	$request['password_1'] = $_POST["password_1"];
	$request['password_2'] = $_POST["password_2"];
	$request['fname']      = $_POST["fname"];
    $request['lname']      = $_POST["lname"];
	$request['age']        = $_POST["age"];
	$request['weight']     = $_POST["weight"];
	$request['height_ft']  = $_POST["height_ft"];
	$request['height_in']  = $_POST["height_in"];
	$request['gender']     = $_POST["gender"];
	$request['activity']   = $_POST["activity"];
	if ($request['password_1'] != $request['password_2']) { array_push($errors, "The two passwords do not match"); }
        if ($request['height_in'] > 12) { array_push($errors, "Enter the correct inches for height"); }
}

//$response = $client->send_request($request);
//$response = $client->publish($request);

//echo "client received response: ".PHP_EOL;
//print_r($response);
//echo "\n\n";
//header('location: index.php');
//echo $argv[0]." END".PHP_EOL;
?>

