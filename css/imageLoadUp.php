<html>
<head>
<title>PHP File Upload example</title>
</head>
<body>
 
<form enctype="multipart/form-data" method="post">
<p>Select image:</p>
<input type="file" name="file"><br/>
<input type="button" value="upload" name="submitImage"> <br/>
</form>
 
</body>
</html>

<?php
if(isset($_POST['submitImage']))
{ 
	$filepath = "images/" . $_FILES["file"]["name"];
 
	if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) 
	{
		echo "<img src=".$filepath." height=200 width=300 />";
	} 
	else 
	{
		echo "Error!";
	}
} 
?>