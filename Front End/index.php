<?php 
session_start(); 

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
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<div class="header">
	<h2>Home Page</h2>
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
	    <?php $user = $_SESSION['json']; ?>

		<p>Welcome <strong><?php echo $user->{'fname'}." ".$user->{'lname'}; ?></strong></p>
		<p><br>Your info: <?php echo $user->{'username'}; ?></p><br>

		
		<p>Age: <?php echo $user->{'age'};?></p>
		<p>Weight: <?php echo $user->{'weight'};?> lbs</p>
		<p>Height: <?php echo $user->{'height_ft'};?>' <?php echo $user->{'height_in'};?>"</p>
		<p>Gender: <?php echo $user->{'gender'};?></p>
		<p>Loss: <?php echo $user->{'loss'};?></p>
		<p>Activity: <?php echo $user->{'activity'};?></p><br>


		<p> <a href="updateprofile.php">Edit Profile</a> </p>
		<p> <a href="viewpref.php">View Preferences</a> </p>
		<p> <a href="foodreccomendation.php">Food Reccomendation</a> </p>
		<p> <a href="rating.php">Food Ratings</a> </p>
		<p> <a href="yelp.php">Yelp</a> </p>
		<p> <a href="calendar02.php">Date</a> </p>
	    	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>
