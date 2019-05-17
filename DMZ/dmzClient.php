#!/usr/bin/php
<?php
session_start(); 

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/danny/Documents/WebServer/webServerLog.txt'); 

$username = "";
$errors = array();

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
echo "ppdClient BEGIN".PHP_EOL;

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
//Show Profile Info
if (isset($_POST['view'])){
	$request = array();
	$request['type']       = "ViewInfo";
	$request['username']   = $_POST["username"];

	$response = $client->send_request($request);
	//Convert JSON to string Array	
	//$fullname = json_decode($response);
	$_SESSION['fname'] = $response;
	//$_SESSION['lname'] = $fullname[0];
	echo "clien received response";
	print_r($response);

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
	$request['type']       = "Search";
	$request['username']   = $_SESSION["username"];
	$request['search']     = $_POST["search"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_encode($response);
		header('location: template.php');	
	}
}


//Set Date
if (isset($_POST['set_date'])) {
	$request = array();
	$request['type']     	= "Date";
	$request['username'] 	= "dv269";
	$request['search']  	= $_POST["term"];
	$request['cuisine']   	= $_POST["cuisine"];
	$request['diet']   	= $_POST["diet"];
	$request['restrictions']= $_POST["restrictions"];
	$request['meal']   	= $_POST["meal"];
	$request['calories']   	= $_POST["calories"];
	$request['location']   	= $_POST["location"];
	$request['mile']   	= $_POST["mile"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_encode($response);
		header('location: template.php');	
	}
}


//YELP RECCOMENDATION
if (isset($_POST['yelp_reccomendation'])) {
	$request = array();
	$request['type']     	= "Yelp";
	$request['username'] 	= $_SESSION["username"];
	$request['search']   	= $_POST["search"];
	$request['location'] 	= $_POST["location"];
	$request['mile']   	= $_POST["mile"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_encode($response);
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
	$request['type']   	= $_POST["type"];
	$request['calories']   	= $_POST["calories"];

	$response = $client->send_request($request);
	echo "client received response: ".PHP_EOL;
	print_r($response);

	if ($response==1) {
		$_SESSION['response'] = json_encode($response);
		header('location: template.php');	
	}
}


echo "ppdClient END".PHP_EOL;


?>

