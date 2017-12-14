<?php
	$friend = $_POST["friend"];
	
	$list = $_POST["list"];
	
	$listev = $_POST["listev"];
	
	$cookie_name = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_name];
	if($fnev == ""){header("Location: ../index.php");}
	require 'labels/labels.php';
	
	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db($dbname,$conn);
	
	$sql = "INSERT INTO `friends` (user, and_his_friend) VALUES (N'".$fnev."', N'".$friend."')";
	if (mysql_query($sql,$conn)== TRUE) 
	{
		mysql_close($conn);
		
		header("Location: listfriends.php?friend=okay");
	}
	else
	{
		header("Location: listfriends.php?friend=notokay");	
	}
?>