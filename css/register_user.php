<?php

include('database_connection.php');

$fname = $_POST['firstname'];
$lname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];

$query = "INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES (NULL, '$fname', '$lname', '$email', '$password');";
$result = $connect->query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>TreesCo - Plant A Tree App</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="js/jquery.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			<h3 align="center"><a href="#">TreesCo Plant A Tree</a></h3>
			<br />
			
			<nav class="navbar navbar-default" role="navigation">
				
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
						</button>
					</div>
					
					<div id="navbar-cart" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="search.html">Search</a></li></li>
							<li><a href="register.html">Register</a></li></li>
							<li><a href="login.html">Login</a></li>
							<li>
								<a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
									<span class="glyphicon glyphicon-shopping-cart"></span>
									<span class="badge"></span>
									<span class="total_price">$ 0.00</span>
								</a>
							</li>
						</ul>
					</div>
					
				</div>
			</nav>
			<div id="popover_content_wrapper" style="display: none">
				<span id="cart_details"></span>
				<div align="right">
					<a href="#" class="btn btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span> Check out
					</a>
					<a href="#" class="btn btn-default" id="clear_cart">
					<span class="glyphicon glyphicon-trash"></span> Clear
					</a>
				</div>
			</div>

			<div id="display_item">
				<p>Account registered <a href="login.html">click here to login</a></p>
			</div>
			
		</div>
	</body>
</html>