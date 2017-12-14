<?php
require 'labels/labels.php';

$fnev = $_POST["fnev"];
$pw = $_POST["pw"];
$fnev = strtolower($fnev);

$dontforgetme = $_POST["dontforgetme"];
$megegyezett_e = false;
$goodtoken = false;
// Create connection
$conn = mysql_connect($servername, $username, $password);
mysql_query("SET NAMES UTF8");
// Check connection
if (mysql_error($conn) != NULL) {
    header("Location: ../index.php?errorwiththedatabase=failed");	
}else if($fnev == "" || $pw == ""){
	header("Location: ../index.php?argumentexception=failed");	
}else{
	
mysql_select_db($dbname,$conn);

$result = mysql_query($query_users,$conn);
while($row = mysql_fetch_array($result)){
	if($fnev == $row[0] && base64_encode($pw) == $row[3]){
		$megegyezett_e = true;
		if($row[10] == "okay"){
			$goodtoken = true;
			break;
		}
	}
}
	if($megegyezett_e == true && $dontforgetme == 1 && $goodtoken == true){
		mysql_close($conn);
		header("Location: ../main_page.php?loginsuccessT=".$fnev."");
	}else if($megegyezett_e == true && $goodtoken == true){
		mysql_close($conn);
		header("Location: ../main_page.php?loginsuccess=".$fnev."");
	}elseif ($megegyezett_e == true && $goodtoken == false){
		mysql_close($conn);
		header("Location: ../index.php?token=confirmrequired");
	}
	else{
		mysql_close($conn);
		header("Location: ../index.php?wrongusernameorpassword=wrong");
	}
}
?>