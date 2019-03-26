<?php

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//require_once('rabbitMQClient.php');
require_once('dbConnection.php');
    
//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/database/logging/log.txt');

//LOGIN
function doLogin($username,$password)
{   
    $connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `account` WHERE username='$username' AND password='$ENCpassword'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***Login successful***\n\n";
      return true;
    }  
    else { 
      echo "\n\t***Wrong username/password combination***\n\n";
      return false; 
    }
}

//REGISTER
function doRegister($username, $email, $password_1, $password_2)
{
    $connection = dbConnection();
    $ENCpassword_1 = sha1($password_1);

    $query = "SELECT * FROM `account` WHERE username='$username'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***User already exists***\n\n";
      return false;
    }  	

    $insert_query = "INSERT INTO `account` (username, email, password, plainPass) 
  			  VALUES('$username', '$email', '$ENCpassword_1', '$password_2')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***New record created successfully***\n\n";
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; 
    }
    return true;
}
//PROFILE
function doProfile($username, $fname, $lname, $age, $weight, $height_ft, $height_in, $gender, $loss, $activity)
{
    $connection = dbConnection();
    $insert_query = "INSERT INTO `profile` (username, fname, lname, age, weight, height_ft, height_in, gender, loss, activity) 
  			  VALUES('$username', '$fname', '$lname', '$age', '$weight', '$height_ft', '$height_in', '$gender', '$activity', '$loss')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***Profile Created***\n\n";
	return true;
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
}
//FOOD SEARCH
function searchFood($username, $search, $course) {
    
    $connection = dbConnection();   
    $query = "SELECT * FROM `food` WHERE username='$username'";
    $result = $connection->query($query);
    if ($result->num_rows == 1){
		$calories =		$r[ "calories" ];
		$cuisine =		$r[ "cuisine" ];
		$diet = 		$r[ "diet" ];
		$restrictions =         $r[ "restrictions" ];
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

function show($username, &$output)
{
    $connection = dbConnection();
    
    $output = "";
    
    $showSql = "SELECT * FROM `profile` WHERE username='$username'";
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
       //echo
       $output .= "<strong>User:</strong> $username<br>";
       $output .= "<strong>Age:</strong> $age<br>";
       $output .= "<strong>Weight:</strong> $weight<br>";
       $output .= "<strong>Height:</strong> $height_ft ft. $height_in in.<br>";
       $output .= "<strong>Gender:</strong> $gender<br>";
       $output .= "<strong>Activity:</strong> $activity<br>"; 
    };

    echo $output;
}

function fullName($username, &$output)
{
    $connection = dbConnection();
    
    $output = "";
    
    $fullNsql = "SELECT * FROM `profile` WHERE username='$username'";
    $result = $connection->query($fullNsql);
    
    while ( $r = $result->fetch_assoc() ) 
    {
       $username   = $r[ "username" ];
       $fname      = $r[ "fname" ];
       $lname      = $r[ "lname" ];
       $output .= "<strong>$fname $lname</strong>";
    }; 
    echo $output;
}

function calorieCalc($username, &$calorie){
	
	$connection = dbConnection();
	$s = "SELECT * FROM `profile` WHERE username='$username'";
        $result = $connection->query($s);
        //($t=mysqli_query($db,$s)) or die (mysqli_error($db));
	//while ( $r = mysqli_fetch_array ($t, MYSQLI_ASSOC) ) 
		while ( $r = $result->fetch_assoc() ) {
		$kg =		$r[ "weight" ];
		$ft = 		$r[ "height_ft" ];
		$in = 		$r[ "height_in" ];
		$y =		$r[ "age" ];
		$gender = 	$r[ "gender" ];
		$activity = 	$r[ "activity"];
		$loss = 	$r[ "loss"];
	}
	
	//convert lb to kg and feet and inches to cm
	$kg *= 0.453592;
	$in += $ft * 12;
	$cm = $in * 2.54;
	
	//choose gender
	if($gender ='male'){
		//$calorie = ((10 * $kg) + (6.25 * $cm) – (5 * $y) + 5);
	}
	if($gender ='female'){
		//$calorie = ((10 * $kg) + (6.25 * $cm) – (5 * $y) – 161);
	}
	
	//choose activity
	if($activity ='bmr'){
		$calorie *= 1;
	}
	if($activity ='sedentary'){
		$calorie *= 1.2;
	}
	if($activity ='light'){
		$calorie *= 1.375;
	}
	if($activity ='moderate'){
		$calorie *= 1.465;
	}
	if($activity ='active'){
		$calorie *= 1.55;
	}
	if($activity ='veryactive'){
		$calorie *= 1.725;
	}
	if($activity ='extraactive'){
		$calorie *= 1.9;
	}
	
	//choose purpose
	if($loss = "maintain"){
		$calorie *= 1; 
	}
	if($loss = "half"){
		$calorie *= .9;
	}
	if($loss = "one"){
		$calorie *= .8;
	}
	if($loss = "extreme"){
		$calorie *= .61;
	}
	
	
	return $calorie;
}

?>
