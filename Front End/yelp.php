<?php 
include('ppdClient.php');
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/rabbitmq/login/logfile.txt'); 

if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
 	header("location: login.php"); 
  } 
?>

<!DOCTYPE html>
<html>
<head>

  <script src="https://api.yelp.com/v3/businesses/search"></script>
  <script type = "text/javascript"> </script>
  

  <title>Yelp Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Yelp</h2>
  </div>

<form id="formSubmit" class="form-wrapper" method="post" action="key.php">
	<?php include('errors.php'); ?>
<div>
    <strong>Select radius to search within<br><br></strong>
	<input type="radio" id="radio1" name="mile" value="500" checked='checked'> 5 Miles<br>
	<input type="radio" id="radio2" name="mile" value="610" > 10 Miles<br>	
	<input type="radio" id="radio3" name="mile" value="715" > 15 Miles<br>
	<input type="radio" id="radio4" name="mile" value="820" > 20 Miles<br>
	<input type="radio" id="radio5" name="mile" value="925" > 25 Miles<br>
	<input type="radio" id="radio6" name="mile" value="1030" > 30 Miles<br><br>

</div>
<div>  
<div class="input-group">            
    <input type="text" id="search" name="search" placeholder="Food" required><br>
    <input type="text" id="location" name="location" placeholder="Zip Code" required><br>
    <input type="text" id="categories" name="categories" placeholder="Categories, use commas to filter"><br>
</div>
<div class="input-group">
    <button type="submit" class="btn" name="yelp" value="Search" id="submit">Search</button>
</div>
</form>


<div 
    id="results">
</div>

</body>
</html>

