<?php 
include('ppdClient.php');;
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', dirname(__FILE__). '/log.txt'); 

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
  	  <input type="text" name="fname" placeholder="Enter first name" required autofocus   automcomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Last Name</label>
  	  <input type="text" name="lname" placeholder="Enter last name" required autofocus   automcomplete=off>
  	</div>
    <div>
      <label>Gender<br></label>
      <input type="radio" name="gender" value="male" checked> Male<br>
      <input type="radio" name="gender" value="female"> Female<br>
      <input type="radio" name="gender" value="other"> Other
    </div>
    <div class="input-group">
  	  <label>Age</label>
  	  <input type="number" name="age" placeholder="Age" required autofocus   automcomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Weight</label>
  	  <input type="number" name="weight" placeholder="Pounds" required autofocus   automcomplete=off>
  	</div>
    <div class="input-group">
  	  <label>Height</label>
  	  <input type="numer" name="height_ft" placeholder="Feet" required autofocus   automcomplete=off> 
      <input type="numer" name="height_in" placeholder="Inches" required autofocus   automcomplete=off>  
  	
       </div>
  	  <label>Loss<br></label>
  	  <input type="radio" name="loss" value="maintain" checked> Maintain<br>
	  <input type="radio" name="loss" value="half"> Half<br>
	  <input type="radio" name="loss" value="one"> One<br>
          <input type="radio" name="loss" value="extreme"> Extreme<br>
  	</div>

       </div>
  	  <label>Activiy<br></label>
  	  <input type="radio" name="activity" value="bmr" checked> BMR<br>
	  <input type="radio" name="activity" value="sedentary"> Sedentary<br>
	  <input type="radio" name="activity" value="light"> Light<br>
          <input type="radio" name="activity" value="moderate"> Moderate<br>
   	  <input type="radio" name="activity" value="active"> Active<br>
	  <input type="radio" name="activity" value="veryactive"> Very Active<br>
	  <input type="radio" name="activity" value="extraactive"> Extra Active<br>
  	</div>
   
  	
    <div class="input-group">
  	  <button type="submit" class="btn" name="profile_user">Submit</button>
  	</div>
  	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  </form>
</body>
</html>
