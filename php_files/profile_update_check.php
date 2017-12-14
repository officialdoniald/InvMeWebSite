<?php
$vnev = $_POST["vnev"];
$knev = $_POST["knev"];
$born = $_POST["born"];
$facebook = $_POST["facebook"];
$twitter = $_POST["twitter"];

require 'labels/labels.php';

$conn = mysql_connect($servername, $username, $password);

mysql_select_db($dbname,$conn);

$cookie_name = "justdontforgettheusername";

$fnev = $_COOKIE[$cookie_name];
if($fnev == ""){header("Location: ../index.php");}
if(isset($_COOKIE[$cookie_name]))
{	
	
	$qry = "UPDATE users SET last_name=N'".$vnev."', first_name=N'".$knev."', born_date='".$born."',facebook=N'".$facebook."',twitter=N'".$twitter."' WHERE username=N'".$fnev."'";
			
	$result = mysql_query($qry,$conn);
	
	if($result == 1)
	{
		header("Location: ../profile_edit_page.php?updateprofile=successfull");
	}
	else
	{
		header("Location: ../profile_edit_page.php?updateprofile=error");
	}
}
else
{
	header("Location: ../index.php");
}
?>