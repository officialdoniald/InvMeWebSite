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
	
	$qry = "DELETE FROM friends WHERE user=N'".$fnev."' AND and_his_friend=N'".$friend."'";
			
			$result = mysql_query($qry,$conn);
			
			if($result == 1)
			{
				if($list == "aha")
				{
					header("Location: listfriends.php?friend=deleted");
				}
				else if($listev == "aha")
				{
					header("Location: event_description.php?friend=deleted&list=aha");
				}
				else
				{
					header("Location: event_description.php?friend=deleted");
				}
			}
			else
			{
				if($list == "aha")
				{
					header("Location: listfriends.php?friend=notdeleted");
				}
				else if($listev == "aha")
				{
					header("Location: event_description.php?friend=deleted&list=aha");
				}
				else
				{
					header("Location: event_description.php?friend=notdeleted");
				}
			}
?>