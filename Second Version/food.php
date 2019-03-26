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
  <title>Food Search</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Food</h2>
  </div>
	
  <form method="post" action="food.php">
  	<?php include('errors.php'); ?>
  	
    <div class="input-group">
  	  <label>Search</label>
  	  <input type="text" name="search" placeholder="Search" required autofocus   automcomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Course</label>
  	  <input type="text" name="course" placeholder="Course" required autofocus   automcomplete=off>
  	</div>
    
  	
    <div class="input-group">
  	  <button type="submit" class="btn" name="food_search">Search</button>
  	</div>
  	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  </form>
</body>
</html>
