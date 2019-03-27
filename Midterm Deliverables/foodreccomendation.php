<?php
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

<meta charset="utf-8"/>

<head>
  <title>Pound per Day Reccomendations</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body> Pound per Day </body>

<form method="GET" action="ppdapi.php">
<label for="search">Search:</label>
	<input type = text   name ="search" id="search"  placeholder="Foods (ex:burger,chicken)"   required   autocomplete="off">
<label for="cuisine">Cuisine:</label>
	<input type = text   name ="cuisine" id="cuisine"  placeholder="Cuisine (ex:american,chinese)"   required   autocomplete="off">
<label for="restriction">Exclude Ingredient:</label>
	<input type = text   name ="restriction" id="restriction"  placeholder="Dislike or Allergic to"   required   autocomplete="off">
<label for="type">Type:</label>
	<input type = text   name ="type" id="type"  placeholder="Meal(ex:breakfast,lunch)"   required   autocomplete="off">
	<label for="diet">Diet:</label>
	<input type = text   name ="diet" id="diet"  required   autocomplete="off">
<label for="calories">Calories:</label>
	<input type = number   name ="calories" id="calories" required   autocomplete="off">
	
	<input type="submit" value="submit" />
</form>

