<?php
setcookie("user", "",time()-(86400 * 30), '/');
setcookie("justdontforgettheusername", "",time()-(86400 * 30), '/');
setcookie("lastselectedevent", "",time()-(86400 * 30), '/');
setcookie("justthenavigation", "", time() - (86400 * 30), "/");
if (isset($_GET["tokenconfirm"]) && $_GET["username"] && $_GET["email"]) {
	$token = $_GET["tokenconfirm"];
	$fnev = $_GET["username"];
	$email = $_GET["email"];
	
	require 'labels/labels.php';
	
	$qry = "DELETE FROM emailwaitforconfirm WHERE username = '".$fnev."' AND token = '".$token."' AND email = '".$email."'";

	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);

	$result = mysql_query($qry,$conn);
	
	if($result == 1)
	{
		$qry = "UPDATE users SET email='".$email."' WHERE username='".$fnev."'";
		
		$result = mysql_query($qry,$conn);
		
		if($result == 1)
		{
			header("Location: ../index.php?changeemail=successfull");
		}
		else
		{
			header("Location: ../index.php?dbexception=error");
		}
	}
	else
	{
		header("Location: ../index.php?dbexception=error");
	}
}else{
	header("Location: ../index.php");
}
//modify a cookie: setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>