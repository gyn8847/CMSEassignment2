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
	
	
	<!--Product Catalog-->
	
	<div style="clear:both:"></div>
	<!--Shopping Cart-->
	<br />
	
	<?php
	$pageName = "cart.php";
	echo displayCart($pageName);
	?>
	
	</div>
</body>
</html>