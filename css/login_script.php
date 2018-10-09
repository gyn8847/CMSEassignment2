<?php

session_start();

require 'database_connection.php';

//echo $_POST["email"] . "<br/>";
//echo $_POST["password"];

$email = $_POST["email"];
$password = $_POST["password"];

$user_id = "id:" . $email . "." . $password;

//echo $user_id;

$_SESSION["user_id"] = $user_id;
echo $_SESSION["user_id"];

$query = "SELECT * FROM users WHERE email = '".$email."'";

$result = $connect->query($query);

if ($result->num_rows == 1) 
{
	$row = $result->fetch_assoc();
	if($email == $row['email'] AND $password == $row['password'])
	{
		$_SESSION["email"] = $email;
		$_SESSION["password"] = $password;
		header("location:index.php");
	}
	else
	{
		echo "<p>Sorry couldn't log that user in</p>";
	}
}

?>