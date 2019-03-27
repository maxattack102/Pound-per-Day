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

if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.html');
  }
if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
 	header("location: login.html"); 
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pound per Day Profile</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Profile</h2>
  </div>
	
  <form method="post" action="profile.php">
  	<?php include('errors.php'); ?>
  	
    <div class="input-group">
  	  <label>First Name</label>
  	  <input type="text" name="fname" placeholder="Enter first name" required autofocus   autocomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lname" placeholder="Enter last name" required autofocus   autocomplete=off>
  	</div>
    <div>
      <label>Gender<br></label>
      <input type="radio" name="gender" value="male" checked> Male<br>
      <input type="radio" name="gender" value="female"> Female<br>
      <input type="radio" name="gender" value="other"> Other
    </div>
    <div class="input-group">
  	  <label>Age</label>
  	  <input type="number" name="age" placeholder="Age" required autofocus   autocomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Weight</label>
  	  <input type="number" name="weight" placeholder="Pounds" required autofocus   autocomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Height</label>
  	  <input type="numer" name="height_ft" placeholder="Feet" required autofocus   autocomplete=off> 
      <input type="numer" name="height_in" placeholder="Inches" required autofocus   autocomplete=off>  
  	
       <div class="input-group">
  	  <label>How Much Do You Want to Lose?</label>
        <select name="loss" id ="loss" autofocus>
            <option value="maintain"> Maintain Weight </option>
            <option value="half"> 0.5 lb </option>
            <option value="one"> 1 lb </option>
            <option value="extreme"> 2 lbs </option>
        </select>
  	</div>

       <div class="input-group">
  	  <label>How Often Do You Exercise?</label>
          <select name="activity" id ="activity" autofocus>
            <option value="bmr"> Maintain/BMR </option>
            <option value="sedentary"> Sedentary: little or no exercise </option>
            <option value="light"> Light: exercise 1-3 times/week </option>
            <option value="moderate"> Moderate: exercise 4-5 times/week </option>
            <option value="active"> Active: daily exercise or intense exercise 3-4 times/week </option>
            <option value="veryactive"> Very Active: intense exercise 6-7 times/week </option>
            <option value="extraactive"> Extra Active: very intense exercise daily, or physical job </option>
        </select> 
  	</div>
  	
    <div class="input-group">
  	  <button type="submit" class="btn" name="profile_user">Submit</button>
  	</div>
  	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  </form>
</body>
</html>
