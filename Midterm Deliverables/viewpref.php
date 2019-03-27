<?php 
session_start(); 

error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/daniel/Documents/frontend/logging/log.txt'); 

include ("dbConnection.php");
include ("dBfunctions.php");

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
	<title>Food</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
	<h2>Food Preferences</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    <?php $username = $_SESSION['username']; ?>
    	<p><br><br><?php viewPref($username, $output); ?></p><br>
        
  <div class="input-group">
	<p> <a href="yelp.php">Yelp</a> </p>
	<p> <a href="updateprofile.php">Edit Profile</a> </p>
	<p> <a href="updatepref.php">Edit Preferences</a> </p>
	<p> <a href="food.php">Food Search</a> </p>
    	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  </div>

    <?php endif ?>
</div>
		
</body>
</html>
