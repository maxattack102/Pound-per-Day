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
<html lang="en">
<head>
	<title> Pound Per Day Date </title>
	<link rel="stylesheet" type="text/css" href="style.css">

	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	  <script>
	  $( function hi() {
	    $( "#datepicker" ).datepicker({
	      showOn: "button",
	      buttonText: "Select date"
	    });
	  } );
	  </script>	

</head>
<body>
<div class="header">
	<h2>Meet someone with your own eating habits!</h2>
</div>
<center>
<form method="post" action="calendar02.php">
	
	<div class="input-group">
		<label id="label">Food:</label>
		<select name="search" id="search" autofocus>
		    <option value="pizza"> Pizza </option>
		    <option value="hamburger"> Hamburger </option>
		    <option value="tacos"> Tacos </option>
		    <option value="empandas"> Empanadas </option>
		    <option value="ceviche"> Ceviche </option>
		    <option value="soup"> Soup </option>
		    <option value="chicken"> Chicken </option>
		    <option value="beans"> Beans </option>
		    <option value="salad"> Salad </option>
	 	    <option value="rice"> Rice  </option>
		    <option value="sushi"> Sushi  </option>
		    <option value="steak"> Steak  </option>
		    <option value="fish"> Fish  </option>
		    <option value="pork"> Pork  </option>
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
		<label id="label">Diet:</label>
		<select name="diet" id="diet" autofocus>
		    <option value="none"> None </option>
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
		<label id="label">Restrictions:</label>
		<select name="restrictions" id="restrictions" autofocus>
		    <option value="none"> None </option>
		    <option value="milk"> Milk </option>
		    <option value="yeast"> Yeast </option>
		    <option value="wheat"> Wheat </option>
		    <option value="flour"> Flour </option>
		    <option value="peanuts"> Peanuts </option>
		    <option value="mushrooms"> Mushrooms </option>
		    <option value="avocado"> Avocado </option>
		    <option value="onions"> Onions </option>
		    <option value="pepers"> Pepers </option>
	       </select>
	</div>
	<div class="input-group">
		<label id="label">Occasion:</label>
		<select name="foodType" id="foodType" autofocus>
		    <option value="breakfast"> Breakfast </option>
		    <option value="lunch"> Lunch </option>
		    <option value="dinner"> Dinner </option>
	       </select>
	</div>
	<div class="input-group">
		<label>Calories:</label>
		<input type="number" name="calories" min="1" max="4000" required autofocus autocomplete=off>
	</div>
	<div class="input-group">
		<label id="label">Location:</label>
		<select name="location" id="location" autofocus>
		    <option value="newark"> Newark </option>
		    <option value="trenton"> Trenton </option>
		    <option value="hoboken"> Hoboken </option>
		    <option value="jersey city"> Jersey City </option>
		    <option value="paramus"> Paramus </option>
		    <option value="fort lee"> Fort Lee </option>
		    <option value="paterson"> Paterson </option>
		    <option value="elizabeth"> Eizabeth </option>
		    <option value="union"> Union </option>
		    <option value="manhattan"> Manhattan </option>
		    <option value="brooklyn"> Brooklyn </option>
		    <option value="bronx"> Bronx </option>
		    <option value="queens"> Queens </option>
		    <option value="cape may"> Cape May </option>
		    <option value="long island"> Long Island </option>
	       </select>
	</div>
	<div class="input-group">
	<label>Miles:</label>
	<input type="radio" id="radio1" name="mile" value="2" checked='checked'> 2 Miles<br>
	<input type="radio" id="radio2" name="mile" value="5" > 5 Miles<br>	
	<input type="radio" id="radio3" name="mile" value="10" > 10 Miles<br>
	<input type="radio" id="radio4" name="mile" value="15" > 15 Miles<br>
	<input type="radio" id="radio5" name="mile" value="20" > 20 Miles<br>
	<input type="radio" id="radio6" name="mile" value="25" > 25 Miles<br><br>
	</div>
	<div>
	<label>Date: </label><br>
		<input type="text" name="datepicker" placeholder="MM/DD/YYYY" id="datepicker">
	</div><br><br>
	
	<div class="input-group">
  	  <button  type="submit" class="btn" name="set_date">Submit</button>
		<p> <a href="index.php?logout='1'" style="color: red;">Logout</a> </p>
  	</div>





</form>
</center>
	
</body>
</html>
