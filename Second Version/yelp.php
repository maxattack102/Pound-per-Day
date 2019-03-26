<?php 
include('ppdClient.php');
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', dirname(__FILE__). '/log.txt'); 

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
	<input type="radio" id="radio1" name="mile" value="1609" checked> 1 Mile<br>
	<input type="radio" id="radio2" name="mile" value="4828"> 3 Miles<br>
	<input type="radio" id="radio3" name="mile" value="8046"> 5 Miles<br>
	<input type="radio" id="radio4" name="mile" value="16093"> 10 Miles<br>
	<input type="radio" id="radio5" name="mile" value="40000"> 25 Miles<br><br>
</div>
<div>              
    <input type="text" id="term" name="term"  size="33" placeholder="Search by Business Name or Keyword" required><br>
    <input type="text" id="location" name="location" size="33"  placeholder="Address, Neighborhood, City, State or Zip" required><br>
    <input type="text" id="categories" name="categories" size="33"  placeholder="Categories, use commas to filter" required><br>
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

