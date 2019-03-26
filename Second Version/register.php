<?php include('ppdClient.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Pound per Day Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<?php include('errors.php'); ?>
  	
    <div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" placeholder="Enter username" required autofocus   automcomplete=off>
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" placeholder="Enter email" required autofocus   automcomplete=off>
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1" placeholder="Password" required autofocus   automcomplete=off>
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2" placeholder="Re-type" required autofocus   automcomplete=off>
  	</div>
      
    <div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Login</a>
  	</p>
  </form>
</body>
</html>
