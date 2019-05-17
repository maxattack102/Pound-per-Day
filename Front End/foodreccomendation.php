<?php
session_start(); 

//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');
ini_set('error_log', '/home/walther/Documents/login/logfile.txt'); 

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
<div class="header">
  	<h2>Food Recommendation</h2>
  </div>

<form method="post" action="ppdapi.php">

	<div class="input-group">
		<label id="label">Search:</label>
		<select name="search" id="search" autofocus>
		    <option value="pizza"> Pizza </option>
		    <option value="hamburger"> Hamburger </option>
		    <option value="tacos"> Tacos </option>
		    <option value="empandas">  Empanadas </option>
		    <option value="ceviche"> Ceviche </option>
		    <option value="soup"> Soup </option>
		    <option value="chicken"> Chicken </option>
		    <option value="beans"> Beans </option>
		    <option value="salad"> Salad </option>
	 	    <option value="rice"> Rice  </option>
		    <option value="sushi"> Sushi  </option>
	  	</select>
	</div>	

	<div class="input-group">
		<label id="label">Cuisine:</label>
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
		    <option value="brazilian"> Brazilian </option>
		    <option value="japanese"> Japanese </option>
	  	</select>
	</div>

	<div class="input-group">
		<label id="label">Exclude Restrictions:</label>
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
		<label id="label">Type:</label>
		<select name="foodType" id="foodType" autofocus>
		    <option value="breakfast"> Breakfast </option>
		    <option value="lunch"> Lunch </option>
		    <option value="dinner"> Dinner </option>
	       </select>
	</div>

	<div class="input-group">
		<label id="label">Diet:</label>
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
		<label>Calories:</label>
		<input type="number" name="calories" min="1" max="4000" required autofocus autocomplete=off>
	</div>

	<div class="input-group">
  	  <button  type="submit" class="btn" >Submit</button>
		<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  	</div>

</form>

