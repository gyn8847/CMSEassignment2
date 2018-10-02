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
echo "Error !!";
}
} 
?>
