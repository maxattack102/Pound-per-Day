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
  <title>Pound per Day Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body> Pound per Day </body>

<form method="GET" action="search.php">
<label for="user">Search:</label>
	<input type = text   name ="search"  placeholder="Foods(ex:burgwe,chicken)"   required   autocomplete="off">
	<input type="submit" value="submit" />
</form>
