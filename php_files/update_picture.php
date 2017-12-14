<?php
$profile_picture = addslashes($_FILES['profile_picture']['tmp_name']);
$profile_picture = file_get_contents($profile_picture);
$profile_picture = base64_encode($profile_picture);
$fileSize = $_FILES['profile_picture']['size'];

require 'labels/labels.php';

$cookie_name = "justdontforgettheusername";

if(isset($_COOKIE[$cookie_name]))
{
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ../index.php");}
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$qry = "UPDATE users SET profile_picture='".$profile_picture."' ,picture_size='".$fileSize."' WHERE username=N'".$fnev."'";
	
	$result = mysql_query($qry,$conn);
	
	mysql_close($conn);
	
	if($result == 1)
	{
		header("Location: ../profile_edit_page.php?updatepicture=successfull");	
	}
	else
	{
		header("Location: ../profile_edit_page.php?updatepicture=error");	
	}
}
else
{
	header("Location: ../index.php");	
}
?>