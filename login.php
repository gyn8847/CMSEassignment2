<!DOCTYPE html>
<html>
<head>
	<title>Plant A Tree - Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/login.css" />
</head>
<body>
	
	
	<!--Login Form-->
	
	<form method="post" action="login_script.php">
	  <div class="imgcontainer">
		<img src="images/plantatreeicon.png" alt="Avatar" class="avatar" class="img-responsive">
		<h3>PlantATree Login</h3>
	  </div>

	  <div class="container">
		<label for="email"><b>Email</b></label>
		<input type="text" placeholder="Enter Email" name="email" required>

		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required>

		<button type="submit">Login</button>
		<label>
		  <input type="checkbox" checked="checked" name="remember"> Remember me
		</label>
	  </div>

	  <div class="container" style="background-color:#f1f1f1">
		<span class="psw">Forgot <a href="#">password?</a></span>
		<p>Don't have an account? <a href="register.html">Create one</a></p>
	  </div>
	</form>
	

</body>
</html>