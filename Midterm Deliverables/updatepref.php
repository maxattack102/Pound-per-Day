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
  <title>Pound per Day Edit Food</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
  <div class="header">
  	<h2>Edit Food </h2>
  </div>
	
  <form method="post" action="updatepref.php">
  	<?php include('errors.php'); ?>
  	
    <div class="input-group">
      <label>Cuisine<br></label>
      <select name="cuisine" id="cuisine" autofocus>
	    <option value="american"> American </option>
	    <option value="chinese"> Chinese </option>
	    <option value="mexican"> Mexican </option>
            <option value="middle eastern"> Middle eastern </option>
            <option value="indian"> Indian </option>
            <option value="cajun"> Cajun </option>
	    <option value="french"> French </option>
            <option value="italian"> Italian </option>
            <option value="thai"> Thai </option>
 	    <option value="vietnamese"> Vietnamese  </option>
      </select>
    </div>

    <div class="input-group">
      <label>Dietary Restrictions<br></label>
      <select name="diet" id="diet" autofocus>
            <option value="vegetarian"> Vegetarian </option>
	    <option value="vegan"> Vegan </option>
            <option value="pescatarian"> Pescatarian </option>
	    <option value="gluten free"> Gluten Free </option>
            <option value="paleo"> Paleo </option>
            <option value="kosher"> Kosher </option>
	    <option value="halal"> Halal </option>
            <option value="meat only"> Meat-Only </option>
            <option value="keto"> Keto </option>
      </select>
    </div>

    <div class="input-group">
      <label>Restrictions<br></label>
      <select name="restrictions" id="restrictions" autofocus>
            <option value="milk"> Milk </option>
            <option value="yeast"> Yeast </option>
            <option value="wheat"> Wheat </option>
            <option value="flour"> Flour </option>
	    <option value="peanuts"> Peanuts </option>
	    <option value="musshrooms"> Mushrooms </option>
	    <option value="avocado"> Avocado </option>
      </select>
    </div>
   
  	
    <div class="input-group">
  	  <button type="submit" class="btn" name="update_food">Submit</button>
  	</div>
  	<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  </form>
</body>
</html>
