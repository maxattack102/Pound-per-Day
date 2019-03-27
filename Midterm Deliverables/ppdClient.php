
<?php
//#!/usr/bin/php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/rabbitmq/error_log/log.txt'); 

$username = "";
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

//LOGIN
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
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		header('location: index.php');	
	}
	else{ array_push($errors, "Wrong username/password combination"); }
}
//REGISTER
if (isset($_POST['reg_user'])) {
	$request = array();
	$request['type']       = "Register";
	$request['username']   = $_POST["username"];
        $request['email']      = $_POST["email"];
	$request['password_1'] = $_POST["password_1"];
	$request['password_2'] = $_POST["password_2"];
	if ($request['password_1'] != $request['password_2']) {  
		array_push($errors, "Passwords don't match");	
	}
	else { $response = $client->send_request($request); }
	//$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);
	
	if ($response==1){
		echo "<strong>New User Registered</strong>";
		$_SESSION['username'] = $request['username'];
      		$_SESSION['success'] = "You are now logged in";
		header('location: profile.php');	
	}
	else{ array_push($errors, "User already exists"); }
}
//PROFILE
if (isset($_POST['profile_user'])) {
	$request = array();
	$request['type']       = "Profile";
	$request['username']   = $_SESSION["username"];
	$request['fname']      = $_POST["fname"];
        $request['lname']      = $_POST["lname"];
	$request['age']        = $_POST["age"];
	$request['weight']     = $_POST["weight"];
	$request['height_ft']  = $_POST["height_ft"];
	$request['height_in']  = $_POST["height_in"];
	$request['gender']     = $_POST["gender"];
	$request['loss']       = $_POST["loss"];
	$request['activity']   = $_POST["activity"];
	if ($request['age'] < 18) { array_push($errors, "Minimum age: 18"); }
	if ($request['height_in'] > 12) { array_push($errors, "Inches: < 12"); }
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo "<strong>Profile Created</strong>";
		header('location: preferences.php'); }
	else{ array_push($errors, "User already has a profile"); }
}
//PREFERENCES
if (isset($_POST['pref_food'])) {
	$request = array();
	$request['type']         = "Preferences";
	$request['username']     = $_SESSION["username"];
	$request['cuisine']      = $_POST["cuisine"];
        $request['diet']         = $_POST["diet"];
	$request['restrictions'] = $_POST["restrictions"];
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo "<strong>Preferences Created</strong>";
		header('location: rating.php'); }
	else{ array_push($errors, "Error 123"); }
}
//RATING
if (isset($_POST['rate_food'])) {
	$request = array();
	$request['type']       = "Rating";
	$request['username']   = $_SESSION["username"];
	$request['selectType'] = $_POST["selectType"];
	$request['foodName']   = $_POST["foodName"];
	$request['rating']     = $_POST["rating"];
	$request['recommend']  = $_POST["recommend"];
	$request['comments']   = $_POST["comments"];
	$request['message']    = $msg;

	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo "<strong>Ratings Added</strong>";
		header('location: index.php');	
	}
	else{ array_push($errors, "Error"); }
}

//****************************************************************************
//UPDATE-PROFILE
if (isset($_POST['update_user'])) {
	$request = array();
	$request['type']       = "Update";
	$request['username']   = $_SESSION["username"];
	$request['fname']      = $_POST["fname"];
        $request['lname']      = $_POST["lname"];
	$request['age']        = $_POST["age"];
	$request['weight']     = $_POST["weight"];
	$request['height_ft']  = $_POST["height_ft"];
	$request['height_in']  = $_POST["height_in"];
	$request['gender']     = $_POST["gender"];
	$request['loss']       = $_POST["loss"];
	$request['activity']   = $_POST["activity"];
	if ($request['age'] < 18) { array_push($errors, "Minimum age: 18"); }
	if ($request['height_in'] > 12) { array_push($errors, "Inches: < 12"); }
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo "<strong>Profile Created</strong>";
		header('location: index.php'); }
	else{ array_push($errors, "Couldn't update"); }
}
//UPDATE-PREFERENCES
if (isset($_POST['update_food'])) {
	$request = array();
	$request['type']         = "Update Pref";
	$request['username']     = $_SESSION["username"];
	$request['cuisine']      = $_POST["cuisine"];
        $request['diet']         = $_POST["diet"];
	$request['restrictions'] = $_POST["restrictions"];
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo "<strong>Preferences Updated</strong>";
		header('location: index.php'); }
	else{ array_push($errors, "Error 123"); }
}




//FOOD-SEARCH
if (isset($_POST['food_search'])) {
	$request = array();
	$request['type']     = "Search";
	$request['username'] = $_SESSION["username"];
	$request['search']   = $_POST["search"];
	$request['course']   = $_POST["course"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		//$_SESSION['response'] = $response;
		header('location: searchfood.php');	
	}
}

?>

