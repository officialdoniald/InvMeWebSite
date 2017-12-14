<?php

$oldpw =$_POST["oldpw"];
$pw = $_POST["pw"];
$pwagain = $_POST["pwagain"];

if($pw != $pwagain)
{
	header("Location: update_profile.php?passwordexception=notequals");		
}else if((strlen($pw) < 6 || strlen($pw) > 16) ||(strlen($pwagain) < 6 || strlen($pwagain) > 16)){
	header("Location: update_profile.php?passwordexception=toolargeorno");	
}
else
{
	require 'labels/labels.php';
	
	$cookie_name = "justdontforgettheusername";	
	
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ../index.php");}
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$qry = "SELECT * FROM users";
	
	mysql_query("SET NAMES UTF8");
	
	$result = mysql_query($qry,$conn);
	
	$megegyezette = false;
	
	while($row = mysql_fetch_array($result))
	{
		if($fnev == $row[0] && $oldpw == base64_decode($row[3]))
		{
			$megegyezette = true;
			
			mysql_close($conn);
			
			$conn = mysql_connect($servername, $username, $password);
	
			mysql_select_db($dbname,$conn);
			
			$qry = "UPDATE users SET password='".base64_encode($pw)."' WHERE username='".$fnev."'";
			
			$result = mysql_query($qry,$conn);
			
			if($result == 1)
			{
				header("Location: ../profile_edit_page.php?updatepassword=successfull");
			}
			else
			{
				header("Location: ../profile_edit_page.php?updatepassword=error");
			}
		}
	}
	if ($megegyezette == false) {
		header("Location: update_profile.php?oldpassword=error");
	}
}

?>