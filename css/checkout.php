<?php
session_start();
$product_ids = array();

require 'database_connection.php';

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
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip">
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
            <input type="text" id="cname" name="cardname">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv">
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


</body>
</html>