<?php
$mylastname = $_POST["mylastname"];
$myfirstname = $_POST["myfirstname"];
$myemail = $_POST["myemail"];
$myborndate = $_POST["myborndate"];
$myprofilepicture = $_POST["myprofilepicture"];
$myfacebookprofile = $_POST["myfacebookprofile"];
$mytwitterprofile = $_POST["mytwitterprofile"];
$hashtagemail = $_POST["hashtagemail"];

if($mylastname != 1)
{
	$mylastname = 0;
}
if($myfirstname != 1)
{
	$myfirstname = 0;
}
if($myemail != 1)
{
	$myemail = 0;
}
if($myborndate != 1)
{
	$myborndate = 0;
}
if($myprofilepicture != 1)
{
	$myprofilepicture = 0;
}
if($myfacebookprofile != 1)
{
	$myfacebookprofile = 0;
}
if($mytwitterprofile != 1)
{
	$mytwitterprofile = 0;
}
if($hashtagemail != 1)
{
	$hashtagemail = 0;
}

require 'labels/labels.php';

$cookie_name = "justdontforgettheusername";

if(isset($_COOKIE[$cookie_name]))
{
	
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ../index.php");}
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$qry = "UPDATE security_users SET last_name=N'".$mylastname ."', first_name=N'".$myfirstname."', email=N'".$myemail."', born_date='".$myborndate."',profile_picture='".$myprofilepicture."',facebook='".$myfacebookprofile."',twitter='".$mytwitterprofile."',hashtagemail='".$hashtagemail."' WHERE username_really=N'".$fnev."'";

	$result = mysql_query($qry,$conn);
	
	if($result == 1)
	{
		header("Location: ../security_page.php?security=successfull");
	}
	else
	{
		header("Location: ../security_page.php?security=notsuccessfull");
	}
}
else
{
	echo 'Fogadd el a cookikat!';
}
?>