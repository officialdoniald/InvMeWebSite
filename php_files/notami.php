<?php
if ($_GET["username"] && $_GET["email"]) {
	$fnev = $_GET["username"];
	$email = $_GET["email"];

	require 'labels/labels.php';

	$qry = "DELETE FROM emailwaitforconfirm WHERE username = '".$fnev."'";

	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db($dbname,$conn);

	$result = mysql_query($qry,$conn);

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
?>