<?php
function($query){
	
	require '../labels/labels.php';
	
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_query("SET NAMES UTF8");
	
	mysql_select_db($dbname,$conn);
	
	$qry = "SELECT * FROM users";
	
	$result = mysql_query($qry,$conn);
	
	return $result;	
}
?>