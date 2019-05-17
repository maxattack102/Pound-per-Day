<?php 
include('ppdClient.php');
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/Logs/genLog.txt'); 

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
	<title> Pound Per Day Rating </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
	<h2>Log & Rate Your Meal:</h2>
</div>
<center>
<form method="post" action="rating.php">
	<div>
		<label>Are you rating a meal or a restaurant?</label><br>
		<input type="radio" name="selectType"  checked> Meal
		<input type="radio" name="selectType" > Restaurant
	</div>
	<div class="input-group">
		<label id="label">Food:</label>
		<input type="text" name="foodName" placeholder="Enter Food Name" required autofocus autocomplete=off>
	</div>
	<div class="input-group">
		<label>Rating from 1-10:</label>
		<input type="number" name="rating" placeholder="1-10" min="1" max="10" required autofocus autocomplete=off>
	</div>
	<div>
		<label>Would you recommend this to a friend?</label><br>
		<input type="radio" name="recommend" checked> Yes
		<input type="radio" name="recommend" > No
	</div>
	<div class="input-group">
		<label>Comments?</label>
		<textarea name="comments" style="width: 85%; height: 100px;" rows="4" cols"50"></textarea>
	</div>
	<div class="input-group">
  	  <button  type="submit" class="btn" name="rate_food">Submit</button>
		<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  	</div>
</form>
</center>
	
</body>
</html>
