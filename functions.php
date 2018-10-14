<?php

// fetches the added items to the shopping cart and stores it in a session
function fetchCart()
{
	session_start();
	$product_ids = array();

	//check if add to cart button has been submitted
	if(filter_input(INPUT_POST, "add_to_cart"))
	{	
		//checks if the shopping cart has products in it
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
	
	//end of fetchCart();
}

function displayCart($pageName)
{
	echo"
	<div class='table-responsive'>
	<table class='table'>
	<tr><th colspan='5'><h3>Shopping Cart</h3></th></tr>
	<tr>
		<th width='40%'>Product Name</th>
		<th width='5%'>Quantity</th>
		<th width='24%'>Price</th>
		<th width='13%'>Total</th>
		<th width='5%'>Action</th>
	</tr>";
	
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
					<a href='".$pageName."?action=delete&id=".$product["id"]."'>
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
		
		echo"
		<tr>
			<td colspan='5'>";
				if(isset($_SESSION["shopping_cart"]))
				{
					if(count($_SESSION["shopping_cart"]) > 0)
					{
						echo "<a href='checkout.php' class='button'>Checkout</a>";
					}
				}echo
			"</td>
		</tr>";
	}
	else
	{
		echo "<tr><td>Your cart is empty</td></tr>";
	}
	echo "	
	</table>
	</div>";
}

//displays the products from the database, 
//filters them by the product type with $prodType in sql query
function displayProduct($prodType)
{
	require 'db_connect.php';
	
	$table_name = "`heroku_731729c0756ab4d` . `product`";
	
	$query = "SELECT * FROM $table_name WHERE type='$prodType' ORDER BY id ASC";
	$result = mysqli_query($connect, $query);
	if(mysqli_num_rows($result) > 0)
	{
		while($product = $result->fetch_assoc())
		{
			echo "
			<div class='col-sm-4 col-md-3' >
				<form method='post' action='index.php?action=add&id=".$product["id"]."'>
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
}

?>