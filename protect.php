<?php

// protects the page, redirects to login page if not logged in
if(!isset($_SESSION['user_id'])) 
{ 
	include('login.php');
	exit();
}

?>