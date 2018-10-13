<?php

if(!isset($_POST["search"]))
{
	header("location:index.php");
}

?>

<?php
session_start();

$product_ids = array();

//check if add to cart button has been submitted
if(filter_input(INPUT_POST, "add_to_cart"))
{	
	//checks if the shopping cart exists
	if(isset($_SESSION["shopping_cart"]))
	{
		//counts how many products are in the shopping cart
		$count = count($_SESSION["shopping_cart"]);
		
		$product_ids = array_column($_SESSION["shopping_cart"], "id");
		
		if(!in_array(filter_input(INPUT_GET, "id"), $product_ids))
		{
			$_SESSION["shopping_cart"][$count] = array
			(
			"id" => filter_input(INPUT_GET, "id"),
			"name" => filter_input(INPUT_POST, "name"),
			"price" => filter_input(INPUT_POST, "price"),
			"quantity" => filter_input(INPUT_POST, "quantity")
			);
		}
		else
		{
			//match array key to id of the product being added to the cart
			for($i = 0; $i < count($product_ids); $i++)
			{
				//updates the quanity of the item in the cart
				if($product_ids[$i] == filter_input(INPUT_GET, "id"))
				{
					$_SESSION["shopping_cart"][$i]["quantity"] += filter_input(INPUT_POST, "quantity");
				}
			}
		}
	}
	else
	{
		//if the shopping cart doesn't exist, then create first product with array key 0
		//create array using submitted form data, start from key 0 and fill it with values
		$_SESSION["shopping_cart"]["0"] = array
		(
			"id" => filter_input(INPUT_GET, "id"),
			"name" => filter_input(INPUT_POST, "name"),
			"price" => filter_input(INPUT_POST, "price"),
			"quantity" => filter_input(INPUT_POST, "quantity")
		);
	}
}

if(filter_input(INPUT_GET, "action") == "delete")
{
	//loop through all the products until you find the product being removed
	foreach($_SESSION["shopping_cart"] as $key => $product)
	{
		if($product["id"] == filter_input(INPUT_GET, "id"))
		{
			//removes the product from the shopping cart when it matches with the product id
			unset($_SESSION["shopping_cart"][$key]);
		}
	}
	//reset the session array keys so they match with $product_ids numeric array
	$_SESSION["shopping_cart"] = array_values($_SESSION["shopping_cart"]);
}

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
	
	
	<!--Product Catalog-->
	
	<?php
	
	require 'db_connect.php';
	
	$psearch = $_POST["search"];
	
	$query = "SELECT * FROM product WHERE name LIKE'%$psearch%' ORDER BY id ASC";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($product = $result->fetch_assoc())
		{
			echo "
			<div class='col-sm-4 col-md-3' >
				<form method='post' action='searchresults.php?action=add&id=".$product["id"]."'>
					<div class='products'>
						<img src='images/".$product["image"]."' class='img-responsive' />
						<h4 class='text-info'>".$product["name"]."</h4>
						<h4>$".$product["price"]."</h4>
						<input type='number' name='quantity' class='form-control' value='1' min='1' />
						<input type='hidden' name='name' value='".$product["name"]."' />
						<input type='hidden' name='price' value='".$product["price"]."' />
						<input type='submit' name='add_to_cart' class='btn btn-info' style='margin-top:5px;' value='Add to Cart' />
					</div>
				</form>
			</div>
			";
		}
	}
	?>
	
	<div style="clear:both:></div>
	<!--Shopping Cart-->
	<br />
	<div class="table-responsive">
	<table class="table">
		<tr><th colspan="5"><h3>Shopping Cart</h3></th></tr>
		<tr>
			<th width="40%">Product Name</th>
			<th width="5%">Quantity</th>
			<th width="24%">Price</th>
			<th width="13%">Total</th>
			<th width="5%">Action</th>
		</tr>
		<?php
		if(!empty($_SESSION["shopping_cart"]))
		{
			$total = 0;
			foreach($_SESSION["shopping_cart"] as $key => $product)
			{
				echo "
				<tr>
					<td>".$product["name"]."</td>
					<td>".$product["quantity"]."</td>
					<td>$ ".$product["price"]."</td>
					<td>$ ".$product["quantity"] * $product["price"]."</td>
					<td>
						<a href='searchresults.php?action=delete&id=".$product["id"]."'>
							<div class='btn-danger'>Remove</div>
						</a>
					</td>
				</tr>"
				;
				
				$total = $total + ($product["quantity"] * $product["price"]);
			}
			echo "
			<tr>
				<td colspan='3' align='right'>Total</td>
				<td align='right'>".$total."</td>
				<td></td>
			</tr>
			";
			?>
			
			<tr>
				<td colspan='5'>
					<?php
						if(isset($_SESSION["shopping_cart"]))
						{
							if(count($_SESSION["shopping_cart"]) > 0)
							{
								echo "<a href='checkout.php' class='button'>Checkout</a>";
							}
						}
					?>
				</td>
			</tr>
			
			<?php
		}
		?>
	</table>
	</div>
		
	</div>
</body>
</html>