#!/usr/bin/php
<?php
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/Logs/genLog.txt');
?>

<!DOCTYPE html>
<html>
<head>
<style>
@font-face {
  font-family: SweetCake;
  src: url("Sweet Cake.otf") format("opentype");
}

* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
}

/* Style the header */
.header {
  font-family: SweetCake;
  text-align: center;
  grid-area: header;
  color:white;
  background-color: #3D85C5;
  padding: 20px;
  text-align: center;
  font-size: 50px;
}

/* The grid container */
.grid-container {
  align-items: stretch;
  display: grid;
  grid-template-areas: 
    'header header header header header header' 
    'left right right right right right' 
    'footer footer footer footer footer footer';
} 

.button {
  background-color: #6FA7DC;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button:hover {
  background-color: black;
  color: white;
}

/* Style the left column */
.left {
  background-color:#AFE7E4;
  padding: 10px;
  height: 700px;
  grid-area: left;
}

/* Style the right column */
.right {
  background-color:#AFE7E4;
  padding: 10px;
  height: 700px;
  grid-area: right;
}

/* Style the footer */
.footer {
  grid-area: footer;
  background-color: #0B5394;
  padding: 10px;
  text-align: center;
}

@media (max-width: 700px) {
  .grid-container  {
    grid-template-areas: 
      'header header header header header header' 
      'left left left left left left' 
      'right right right right right right' 
      'footer footer footer footer footer footer';
  }

</style>
</head>

<body>

<div class="grid-container">
  <div class="header">
    <h2>Pound per Day</h2>
  </div>
  
  <div class="left">
	<button style="width:200px" class="button" <p> <a href="updateprofile.php">Edit Profile</a> </p> </button><br>
	<button style="width:200px" class="button" <p> <a href="viewpref.php">View Preferences</a> </p> </button><br>
	<button style="width:200px" class="button" <p> <a href="foodreccomendation.php">Food Reccomendation</a> </p></button><br>
	<button style="width:200px" class="button" <p> <a href="rating.php">Food Ratings</a> </p></button><br>
	<button style="width:200px" class="button" <p> <a href="yelp.php">Yelp</a> </p></button><br>
	<button style="width:200px" class="button" <p> <a href="calendar02.php">Date</a> </p></button><br>
        <button style="width:200px" class="button" <p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p></button><br>
  </div>
  <div class="right" >
<?php

echo $_SESSION['response'];

?></div>

  <div class="footer">
    <p>Footer</p>
  </div>
</div>

</body>
</html>
