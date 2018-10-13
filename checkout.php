<?php
require 'functions.php';
echo fetchCart();
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/checkout.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>

	<div class="container">
	
	<!-- Side Nav Menu -->
	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<form class="example" action="searchresults.php" method="post">
			<input type="text" placeholder="Search.." name="search">
			<button type="submit" style="margin-top:5px;"><i class="fa fa-search"></i></button>
		</form>	  
		<a href="index.php">Browse</a>
		<button class="dropdown-btn">Account 
			<i class="fa fa-caret-down"></i>
		</button>
		<div class="dropdown-container">
			<a href="image_drag.php">Image Dragger</a>
			<a href="orders.php">Orders</a>
			<a href="logout.php">Logout</a>
		</div>
		<a href="cart.php">Cart</a>
	</div>
	
	<!-- Menu slideout button -->
	<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
	<hr />
	
	<script>
	function openNav() 
	{
		document.getElementById("mySidenav").style.width = "250px";
	}

	function closeNav() 
	{
		document.getElementById("mySidenav").style.width = "0";
	}
	</script>
	
	<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
	  dropdown[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") {
		  dropdownContent.style.display = "none";
		} else {
		  dropdownContent.style.display = "block";
		}
	  });
	}
	</script>
	
	<div class="row">
	  <div class="col-75">
		<div class="container">
		  <form action="/action_page.php">
		  
			<div class="row">
			  <div class="col-50">
				<h3>Billing Address</h3>
				<label for="fname"><i class="fa fa-user"></i> Full Name</label>
				<input type="text" id="fname" name="firstname" placeholder="John M. Doe">
				<label for="email"><i class="fa fa-envelope"></i> Email</label>
				<input type="text" id="email" name="email" placeholder="john@example.com">
				<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
				<input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
				<label for="city"><i class="fa fa-institution"></i> City</label>
				<input type="text" id="city" name="city" placeholder="New York">

				<div class="row">
				  <div class="col-50">
					<label for="state">State</label>
					<input type="text" id="state" name="state" placeholder="NY">
				  </div>
				  <div class="col-50">
					<label for="zip">Zip</label>
					<input type="text" id="zip" name="zip" placeholder="10001">
				  </div>
				</div>
			  </div>

			  <div class="col-50">
				<h3>Payment</h3>
				<label for="fname">Accepted Cards</label>
				<div class="icon-container">
				  <i class="fa fa-cc-visa" style="color:navy;"></i>
				  <i class="fa fa-cc-amex" style="color:blue;"></i>
				  <i class="fa fa-cc-mastercard" style="color:red;"></i>
				  <i class="fa fa-cc-discover" style="color:orange;"></i>
				</div>
				<label for="cname">Name on Card</label>
				<input type="text" id="cname" name="cardname" placeholder="John More Doe">
				<label for="ccnum">Credit card number</label>
				<input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
				<label for="expmonth">Exp Month</label>
				<input type="text" id="expmonth" name="expmonth" placeholder="September">
				<div class="row">
				  <div class="col-50">
					<label for="expyear">Exp Year</label>
					<input type="text" id="expyear" name="expyear" placeholder="2018">
				  </div>
				  <div class="col-50">
					<label for="cvv">CVV</label>
					<input type="text" id="cvv" name="cvv" placeholder="352">
				  </div>
				</div>
			  </div>
			  
			</div>
			<label>
			  <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
			</label>
			<input type="submit" value="Continue to checkout" class="btn">
		  </form>
		</div>
	  </div>
	</div>
	</div>

</body>
</html>