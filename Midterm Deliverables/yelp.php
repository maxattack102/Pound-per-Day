<?php 
include('ppdClient.php');
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/frontend/logging/log.txt'); 

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
	<input type="radio" id="radio1" name="mile" value="25" checked='checked'> 25 Miles<br>
	<input type="radio" id="radio2" name="mile" value="50" > 50 Miles<br>	
	<input type="radio" id="radio3" name="mile" value="100" > 100 Miles<br>
	<input type="radio" id="radio4" name="mile" value="200" > 200 Miles<br>
	<input type="radio" id="radio5" name="mile" value="300" > 300 Miles<br>
	<input type="radio" id="radio6" name="mile" value="500" > 500 Miles<br><br>

</div>
<div>  
<div class="input-group">            
    <input type="text" id="term" name="term" placeholder="Search by Business Name or Keyword" required><br>
    <input type="text" id="location" name="location" placeholder="Address, Neighborhood, City, State or Zip" required><br>
    <input type="text" id="categories" name="categories" placeholder="Categories, use commas to filter" required><br>
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

