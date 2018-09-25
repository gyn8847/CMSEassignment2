<?php
session_start();
$connect = mysqli_connect("localhost", "malachi", "malachi", "malachi");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>
<body style="font-family:Verdana;">

<div style="background-color:#f1f1f1;padding:15px;">
  <h1>Trees Co</h1>
  <h3>Plant A Tree</h3>
</div>

<div style="overflow:auto">
  <div class="menu">
    <div class="menuitem"><a href="index.html" id="home">Home</a></div>
    <div class="menuitem"><a href="search.html" id="search">Search</a></div>
    <div class="menuitem"><a href="login.html" id="login">Login</a></div>
    <div class="menuitem"><a href="register.html" id="home">Register</a></div>
  </div>

  <div class="main">
	<h2>Product Catalog</h2>
	
	<?php
	
	$db = "malachi";
	$host = "localhost";
	$user = "malachi";
	$pw = "malachi";
	$conn = new mysqli($host, $user, $pw, $db) 
	OR die("Connection failed: " . $conn->connect_error);
	
	$query = "select * from products order by p_id asc";
	$result = $conn->query($query);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			?>
			
			<div class="col-md-3">
            <form method="post" action="shop.php?action=add&id=<?php echo $row["p_id"]; ?>">
            <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
            <img src="<?php echo $row["p_image"]; ?>" class="img-responsive" width="250" height="250">
            <h5 class="text-info"><?php echo $row["p_name"]; ?></h5>
			<h5 class="text-info">Desc: <?php echo $row["p_description"]; ?></h5>
            <h5 class="text-danger">$ <?php echo $row["p_price"]; ?></h5>
            <input type="number" name="quantity" value="1">
            <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row["p_price"]; ?>">
            <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Add to Cart">
            </div>
            </form>
            </div>
			
			<?php
		}
	}
	
	
	
	?>
	
  </div>

  <div class="right">
    <h2>Shopping Cart</h2>
	 <table class="table table-bordered">
    <tr>
    <th width="40%">Product Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price Details</th>
    <th width="15%">Order Total</th>
    <th width="5%">Action</th>
    </tr>
    <?php
	if(!empty($_SESSION["cart"]))
	{
		$total = 0;
		foreach($_SESSION["cart"] as $keys => $values)
		{
			?>
            <tr>
            <td><?php echo $values["item_name"]; ?></td>
            <td><?php echo $values["item_quantity"] ?></td>
            <td>$ <?php echo $values["product_price"]; ?></td>
            <td>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></td>
            <td><a href="shop.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
            <?php 
			$total = $total + ($values["item_quantity"] * $values["product_price"]);
		}
		?>
        <tr>
        <td colspan="3" align="right">Total</td>
        <td align="right">$ <?php echo number_format($total, 2); ?></td>
        <td></td>
        </tr>
		<tr>
		<td></td><td></td><td></td><td></td>
		<td><button>Checkout</button></td>
		</tr>
        <?php
	}
	?>
    </table>
  </div>
</div>


<div style="background-color:#f1f1f1;text-align:center;padding:10px;margin-top:7px;font-size:12px;"> This web page is a part of a demonstration of fluid web design made by w3schools.com. Resize the browser window to see the content respond to the resizing.</div>

</body>
</html>
