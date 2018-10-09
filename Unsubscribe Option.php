<?php 
 
$user = "user_name";  
$password = "password";  
$host = "host_name";  
$dbase = "database_name";  
$table = "table_name";  
 
 
$email_entered= $_POST['emailentered']; 

 
$from= 'support@learningaboutelectronics.com'; 
 
$subject= $_POST['subject']; 
$body= $_POST['body']; 
 
// Connection to DBase  
$dbc= mysqli_connect($host,$user,$password, $dbase)  
or die("Unable to select database"); 
 
 
$query="DELETE FROM email_list WHERE email='$email_entered'"; 
$result= mysqli_query ($dbc, $query)  
or die ('Error querying database.'); 
 
 
mysqli_close($dbc); 
?> 
 
 
<p id="para1">You have successfully unsubscribed from this newsletter. 