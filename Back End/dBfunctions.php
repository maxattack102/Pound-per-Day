<?php

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
//require_once('rabbitMQClient.php');
    
//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/database/logging/log.txt');


//DATE-MX
function doDate($username,$search,$cuisine,$diet,$restrictions,$foodType,$calories,$location,$mile,$date)
{
    $connection = dbConnection(); 

    $insert_query = "INSERT INTO `date` (username, search, cuisine, diet, restrictions, type, calories, location, mile, date) VALUES('$username', '$search', '$cuisine', '$diet', '$restrictions', '$foodType', '$calories', '$location', '$mile', '$date')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***Date Inserted***\n\n";
        sendEmail($username);
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; 
    }
    return true;
}

function sendEmail($username)
{
    $connection = dbConnection();
    $emaildb = "SELECT * FROM `account` WHERE username='$username'";
    $result = $connection->query($emaildb);
    while ( $r = $result->fetch_assoc() ) 
    {
       $username   = $r[ "username" ];
       $email      = $r[ "email" ];
    }; 
    //$to = $email;
    $subject = "You've been matched on Weight Watchers";
    $message = "<b>You have a date soon! </b>".$username;

    $header = "From: weightwatchers@ww.com\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retVal = mail($email,$subject,$message,$header);
    if($retVal == true){
	echo "Email sent succsfully to: ".$email.PHP_EOL;   
    }
    else{
	echo "Email could not be sent to:".$email.PHP_EOL;    
    }
}

//LOGIN-DV
function doLogin($username,$password)
{   
    $connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `account` WHERE username='$username' AND password='$ENCpassword'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***Login successful***\n\n";
      return show($username);
    }  
    else { 
      echo "\n\t***Wrong username/password combination***\n\n";
      return false; 
   }
}
//REGISTER-DV
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
//PROFILE-DV
function doProfile($username, $fname, $lname, $age, $weight, $height_ft, $height_in, $gender, $loss, $activity)
{
    $connection = dbConnection();
    
    $insert_query = "INSERT INTO `profile` (username, fname, lname, age, weight, height_ft, height_in, gender, loss, activity) 
  	VALUES('$username', '$fname', '$lname', '$age', '$weight', '$height_ft', '$height_in', '$gender', '$activity', '$loss')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***Profile Created***\n\n";
	calorieCalculator($username);
	grading($username);
	return true;
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
}

function grading($username)
{
	$connection = dbConnection();
	$s = "SELECT * FROM `calories` WHERE username='$username'";
	$result = $connection->query($s);
	while ( $r = $result->fetch_assoc() ) {
		$calorie =		$r[ "calories" ];
	}
	
	if ($calorie <= 50 ){
		$grade = 'A';
	}
	else if ($calorie <= 100){
		$grade = 'B';
	}
	else if ($calorie <= 150){
		$grade = 'C';
	}
	else if ($calorie <= 200){
		$grade = 'D';
	}
	else if ($calorie >= 201){
		$grade = 'F';
	}
	else{ $grade = 'n/a'; }
	
	$insert_query = "INSERT INTO `leaderboard` (username, grade) 
				VALUES('$username','$grade')";

	if ($connection->query($insert_query) === TRUE) {
        	echo "\n\n\t***LeaderBoard Updated***\n\n";
    	} 
    	else{
        	echo "Error: " . $insert_query . "<br>" . $connection->error;
    	}	
}

function calorieCalculator($username){
	
	$connection = dbConnection();
	$s = "SELECT * FROM `profile` WHERE username='$username'";
        $result = $connection->query($s);
	while ( $r = $result->fetch_assoc() ) {
		$kg =		$r[ "weight" ];
		$ft = 		$r[ "height_ft" ];
		$in = 		$r[ "height_in" ];
		$y =		$r[ "age" ];
		$gender = 	$r[ "gender" ];
		$activity = 	$r[ "activity"];
		$loss = 	$r[ "loss"];
	}

	//choose gender
	if($gender === "male"){
		$calorie = (10 * ($kg * 0.453592)) + (6.25 * ((($ft*12)+$in)*2.54)) - (5 * $y) + 5;
	}
	if($gender === "female"){
		$calorie = (10 * ($kg * 0.453592)) + (6.25 * ((($ft*12)+$in)*2.54)) - (5 * $y) - 161;
	}
	//choose activity
	if($activity == 'bmr'){
		$calorie *= 1;
	}
	if($activity == 'sedentary'){
		$calorie *= 1.2;
	}
	if($activity == 'light'){
		$calorie *= 1.375;
	}
	if($activity == 'moderate'){
		$calorie *= 1.465;
	}
	if($activity == 'active'){
		$calorie *= 1.55;
	}
	if($activity == 'veryactive'){
		$calorie *= 1.725;
	}
	if($activity == 'extraactive'){
		$calorie *= 1.9;
	}
	
	//choose purpose
	if($loss == "maintain"){
		$calorie *= 1; 
	}
	else if($loss == "half"){
		$calorie *= 0.9;
	}
	else if($loss == "one"){
		$calorie *= 0.8;
	}
	else if($loss == "extreme"){
		$calorie *= 0.61;
	}
	
	$insert_query = "INSERT INTO `calories` (username, calories) VALUES('$username', '$calorie')";

    	if ($connection->query($insert_query) === TRUE) {
        	echo "\n\n\t***Calories Inserted***\n\n";
    	} 
    	else{
       		echo "Error: ".$insert_query."<br>".$connection->error;
	}
	echo $calorie;
	//return $calorie; //added for doProfile
}

//PREFERENCES-DV
function doPref($username, $cuisine, $diet, $restrictions)
{
    $connection = dbConnection();
    $insert_query = "INSERT INTO `food` (username, cuisine, diet, restrictions) 
		VALUES('$username', '$cuisine', '$diet', '$restrictions')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***Preferences Created***\n\n";
	return true;
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
}

//RATING-DV
function doRating($username, $selectType, $foodName, $rating, $recommend, $comments)
{
    $connection = dbConnection();
    	
    $insert_query = "INSERT INTO `ratings` (username, selectType, foodName, rating, recommend, comments) 
  			  VALUES('$username', '$selectType', '$foodName', '$rating', '$recommend', '$comments')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***Ratings Inserted***\n\n";
	return true;
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; 
    }
    
}

//**********************************************************************************************
//UPDATE-PROFILE-DV
function doUpdate($username, $fname, $lname, $age, $weight, $height_ft, $height_in, $gender, $loss, $activity)
{
    $connection = dbConnection();
    $update_query = "UPDATE `profile`
			SET 	fname 	  = '$fname', 
				lname 	  = '$lname', 
				age 	  = '$age', 
				weight 	  = '$weight', 
				height_ft = '$height_ft', 
				height_in = '$height_in', 
				gender 	  = '$gender', 
				loss 	  = '$loss', 
				activity  = '$activity' 
			WHERE username = '$username'";

    if ($connection->query($update_query) === TRUE) {
        echo "\n\n\t***Profile Updated***\n\n";
	updateCalorie($username);
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
    return true;
}
//UPDATE-PREFERENCES-DV
function doUpdatePref($username, $cuisine, $diet, $restrictions)
{
    $connection = dbConnection();
    $update_query = "UPDATE `food`  
		SET	cuisine	 	= '$cuisine', 
			diet 		= '$diet', 
			restrictions 	= '$restrictions'
		 WHERE username = '$username'";

    if ($connection->query($update_query) === TRUE) {
        echo "\n\n\t***Preferences Updated***\n\n";
	return true;
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; }
}



//FOOD SEARCH-MAXIM
function searchFood($username, $search, $course) {
    
    $connection = dbConnection();
    $output = "";
    $query = "SELECT * FROM `food` WHERE user='$username'";

    $result = $connection->query($query);
    
    while ( $r = $result->fetch_assoc() ) 
    {
       $cuisine           = $r[ "cuisine" ];
       $diet              = $r[ "diet" ];
       $restrictions      = $r[ "restrictions" ];
    }; 

    
	$response = Unirest\Request::get("https://spoonacular-recipe-food-nutrition-v1.p.rapidapi.com/recipes/searchComplex?query=" & $search & "&cuisine=" & $cuisine & "&excludeIngredients=" & $restrictions & "type=" & $course & "&ranking=2&minCalories=0&maxCalories=" & $calories & "&limitLicense=false&offset=0&number=100",
	array(
		"X-RapidAPI-Key" => "e15d210dd7mshd26dc31e4212daep1fb5d2jsnb33fb9faa4f2"
		)
	);
	
	$fp = fopen ( $response , "r" ); 
	$output .= "";
	while ( $more = fread ( $fp, 1000  ) ) {      
		$output .=  $more ;   
	}
	//echo $output;
	return true;
}



//INDEX.PHP-DV
function show($username) //, &$output
{
    $connection = dbConnection();
    
    $showSql = "SELECT * FROM `profile` WHERE username='$username'";
    $result = $connection->query($showSql);
    $data = [];
    while ( $r = $result->fetch_assoc() ) 
      {
         $username   = $r[ "username" ];
         $fname      = $r[ "fname" ];
         $lname      = $r[ "lname" ];
         $age 	     = $r[ "age" ];
         $weight     = $r[ "weight" ];
         $height_ft  = $r[ "height_ft" ];
         $height_in  = $r[ "height_in"]; 
         $gender     = $r[ "gender" ];
         $loss 	     = $r[ "loss" ];
         $activity   = $r[ "activity" ];
      };

    $showPref = "SELECT * FROM `food` WHERE username='$username'";
    $result = $connection->query($showPref);
    while ( $r = $result->fetch_assoc() ) 
      {
         $username     = $r[ "username" ];
         $cuisine      = $r[ "cuisine" ];
         $diet         = $r[ "diet" ];
         $restrictions = $r[ "restrictions" ];
      };	

    $data = array("username"=>$username, "fname"=>$fname, "lname"=>$lname, "age"=>$age, "weight"=>$weight, "height_ft"=>$height_ft, "height_in"=>$height_in, "gender"=>$gender, "loss"=>$loss, "activity"=>$activity, "cuisine"=>$cuisine, "diet"=>$diet, "restrictions"=>$restrictions);
      //$all_info = array('data'=>$data);
      echo "\n\n\t***Show Profile***\n\n";
      return json_encode($data);
    //echo $output;
}
//INDEX.PHP-DV
function fullName($username) //&$output
{
    $connection = dbConnection();
    
    $json_array = array();
    
    $fullNsql = "SELECT * FROM `profile` WHERE username='$username'";
    $result = $connection->query($fullNsql);
    
    while ( $r = $result->fetch_assoc() ) 
    {
       $username   = $r[ "username" ];
       $fname      = $r[ "fname" ];
       $lname      = $r[ "lname" ];
    }; 
    $json_array = array("username"=>$username, "fname"=>$fname, "lname"=>$lname);
    echo "\n\n\t***Full Name***\n\n";
    return json_encode($json_array);
}
//VIEWPREF.PHP-DV
function viewPref($username)
{

    $connection = dbConnection();   
    $pref = "SELECT * FROM `food` WHERE username='$username'";
    $result = $connection->query($pref);
    $data = [];
    while ( $r = $result->fetch_assoc() ) 
      {
         $username     = $r[ "username" ];
         $cuisine      = $r[ "cuisine" ];
         $diet         = $r[ "diet" ];
         $restrictions = $r[ "restrictions" ]; 
      };
      $data = array("username"=>$username, "cuisine"=>$cuisine, "diet"=>$diet, "restriction"=>$restrictions);
      //$all_info = array('data'=>$data);
      echo "\n\n\t***Show Preferences***\n\n";
      return json_encode($data);
}
//MAXIM-REVISED


//caloriecalculator();
function leaderboard()
{
	$connection = dbConnection();
	$s = "select * from leaderboard";
	$result = $connection->query($s);
	while ( $r = $result->fetch_assoc() ) {
		$username =		$r[ "username" ];
		$grade =	$r[ "grade" ];
	}
	
	echo $username;
	echo "<br>";
	echo $grade;
	
}


//UPDATE-CALORIE
function updateCalorie($username){
	
	$connection = dbConnection();
	$s = "SELECT * FROM `profile` WHERE username='$username'";
        $result = $connection->query($s);
	while ( $r = $result->fetch_assoc() ) {
		$kg =		$r[ "weight" ];
		$ft = 		$r[ "height_ft" ];
		$in = 		$r[ "height_in" ];
		$y =		$r[ "age" ];
		$gender = 	$r[ "gender" ];
		$activity = 	$r[ "activity"];
		$loss = 	$r[ "loss"];
	}

	if($gender === "male"){
		$calorie = (10 * ($kg * 0.453592)) + (6.25 * ((($ft*12)+$in)*2.54)) - (5 * $y) + 5;
	}
	if($gender === "female"){
		$calorie = (10 * ($kg * 0.453592)) + (6.25 * ((($ft*12)+$in)*2.54)) - (5 * $y) - 161;
	}
	//choose activity
	if($activity == 'bmr'){
		$calorie *= 1;
	}
	if($activity == 'sedentary'){
		$calorie *= 1.2;
	}
	if($activity == 'light'){
		$calorie *= 1.375;
	}
	if($activity == 'moderate'){
		$calorie *= 1.465;
	}
	if($activity == 'active'){
		$calorie *= 1.55;
	}
	if($activity == 'veryactive'){
		$calorie *= 1.725;
	}
	if($activity == 'extraactive'){
		$calorie *= 1.9;
	}
	
	//choose purpose
	if($loss == "maintain"){
		$calorie *= 1; 
	}
	else if($loss == "half"){
		$calorie *= 0.9;
	}
	else if($loss == "one"){
		$calorie *= 0.8;
	}
	else if($loss == "extreme"){
		$calorie *= 0.61;
	}
	
    $update_query = "UPDATE `calories`  
			SET calories  = '$calorie'
		     WHERE username = '$username'";


    if ($connection->query($update_query) === TRUE) {
        echo "\n\n\t***Calories Updated***\n\n";
    } 
    else{
        echo "Error: " . $insert_query . "<br>" . $connection->error;
    }
}

?>

