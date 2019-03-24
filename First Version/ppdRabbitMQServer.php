#!/usr/bin/php
<?php
session_start();

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');

    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    ini_set('log_errors', 'On');

// initializing variables
$username = "";
$email    = "";
$errors = array();

function doLogin($username,$password){
    $connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `accounts` WHERE username='$username' AND password='$ENCpassword'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***Login successful***\n\n";
      //$_SESSION['username'] = $username;
      //$_SESSION['success'] = "You are now logged in";
      //header('location: index.php');
      return true;
    }  
    else 
    { echo "\n\t***Wrong username/password combination***\n\n";
	return false; }
}

function doRegister($username, $email, $password_1, $password_2, $fname, $lname, $age, $weight, $height_ft, $height_in, $gender, $activity){
    $connection = dbConnection();
    $ENCpassword_1 = sha1($password_1);
    $insert_query = "INSERT INTO accounts (username, email, password, plainPass, fname, lname, age, weight, height_ft, height_in, gender, activity) 
  			  VALUES('$username', '$email', '$ENCpassword_1', '$password_2', '$fname', '$lname', '$age', '$weight', '$height_ft', '$height_in', '$gender', '$activity')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***New record created successfully***\n\n";
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
    
    return true;
}

function searchFood($username, $search, $course){
	$connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `accounts` WHERE username='$username'";
    $result = $connection->query($query);
	if ($result->num_rows == 1){
		$calories =		$r[ "calories" ];
		$cuisine =		$r[ "cuisine" ];
		$diet = 		$r[ "diet" ];
		$restrictions = $r[ "restrictions" ];
	}
	$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=" & $search & "&cuisine=" & $cuisine & "&excludeIngredients=" & $restrictions & "type=" & $course & "&ranking=2&minCalories=0&maxCalories=" & $calories & "&limitLicense=false&offset=0&number=100",
	array(
		"X-RapidAPI-Key" => "e15d210dd7mshd26dc31e4212daep1fb5d2jsnb33fb9faa4f2"
		)
	);
	$fp = fopen ( $response , "r" ); 
	$contents = "";
	while ( $more = fread ( $fp, 1000  ) ) {      
		$contents .=  $more ;   
	}
	return $contents;

}

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
    case "Login":
      echo "\n*Type: Login\n";
      return doLogin($request['username'],$request['password']);
    case "Register":
      echo "\n*Type: Registration\n";
      return doRegister($request['username'],$request['email'],$request['password_1'],$request['password_2'],$request['fname'],$request['lname'],$request['age'],$request['weight'],$request['height_ft'],$request['height_in'],$request['gender'],$request['activity']);
    case "Search":
	  echo "\n*Type: Search\n";
	  return searchFood($request['username'],$request['search'],$request['course']);
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

