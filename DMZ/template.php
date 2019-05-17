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
}
</style>
</head>

<body>

<div class="grid-container">
  <div class="header">
    <h2>Pound per Day</h2>
  </div>
  
  <div class="left" >
	<button type="button" style="width:200px" class="button" formaction="updateprofile.php">Edit Profile</button><br>
	<button type="button" style="width:200px" class="button" formaction="viewpref.php">View Preferences</button><br>
	<button type="button" style="width:200px" class="button" formaction="searchfood.php">Food Search</button><br>
	<button type="button" style="width:200px" class="button" formaction="foodrecommendation.php">Food Reccomendation</button><br>
	<button type="button" style="width:200px" class="button" formaction="yelp.php">Yelp</button><br>
  </div>
  <div class="right" >
<?php

session_start(); 
echo $_SESSION['response'];

?></div>

  <div class="footer">
    <p>Footer</p>
  </div>
</div>

</body>
</html>
