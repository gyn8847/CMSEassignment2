<?php
require 'functions.php';

//calls the fetchCart() function from the required functions.php file
echo fetchCart();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Plant A Tree</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/cart.css" />
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
	//opens the side nav menu
	function openNav() 
	{
		document.getElementById("mySidenav").style.width = "250px";
	}

	//closes the side nav menu
	function closeNav() 
	{
		document.getElementById("mySidenav").style.width = "0";
	}
	</script>
	
	<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) 
	{
	  dropdown[i].addEventListener("click", function() 
	  {
		this.classList.toggle("active");
		var dropdownContent = this.nextElementSibling;
		if (dropdownContent.style.display === "block") 
		{
		  dropdownContent.style.display = "none";
		} 
		else 
		{
		  dropdownContent.style.display = "block";
		}
	  });
	}
	</script>
	
	<script>
	function displayTrees() 
	{
		var x = document.getElementById("trees");
		if (x.style.display === "none") 
		{
			x.style.display = "block";
		} 
		else 
		{
			x.style.display = "none";
		}
	}
	
	function displayPlants() 
	{
		var x = document.getElementById("plants");
		if (x.style.display === "none") 
		{
			x.style.display = "block";
		} 
		else 
		{
			x.style.display = "none";
		}
	}
	
	function displaySupplies() 
	{
		var x = document.getElementById("supply");
		if (x.style.display === "none") 
		{
			x.style.display = "block";
		} 
		else 
		{
			x.style.display = "none";
		}
	}
	
	</script>
	
	
	
	<!--Product Catalog-->
	
	<button class=""onclick="displayTrees()" style="
	background-color: #4CAF50; /* Green */
    border: none;
    color: white;
	margin: 0 auto;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: block;
    font-size: 16px;
	height:auto;
	width:100%;">Trees</button><br/>

	<div id="trees" style="display:none;">
	
	<?php
	$prodType = "tree";
	echo displayProduct($prodType);
	?>
	</div>
	
	<!--Display the plants from products table-->
	<button onclick="displayPlants()" style="
	background-color: #4CAF50; /* Green */
    border: none;
    color: white;
	margin: 0 auto;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: block;
    font-size: 16px;
	height:auto;
	width:100%;">Plants</button><br />
	
	<div id="plants" style="display:none;">
	
	<?php
	$prodType = "plant";
	echo displayProduct($prodType);
	?>
	
	</div>
	<!--End of display plants-->
	
	<div style="clear:both:"></div>
	
	<button onclick="displaySupplies()" style="
	background-color: #4CAF50; /* Green */
    border: none;
    color: white;
	margin: 0 auto;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: block;
    font-size: 16px;
	height:auto;
	width:100%;">Garden Supplies</button><br />
	
	<div id="supply" style="display:none;">
	
	<?php
	$prodType = "garden";
	echo displayProduct($prodType);
	?>
	
	</div>
	
	<div style="clear:both:"></div>
	
	<!--End of product catalog-->
	
	<!-- Shopping Cart -->
	<br />
	<?php
	$pageName = "index.php";
	//displays the shopping cart on the webpage
	echo displayCart($pageName);
	?>
	</div>
</body>
</html>