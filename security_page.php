<!doctype html>
<html>
<head>
<title>Security Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="images/logo.jpg">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
<div align="center">
<?php 
  require 'php_files/labels/labels.php';
  menubar();
  ?>
</div>
<div align="center">
<h2 style="color:white; font-size:36px">Security settings</h2>
<h4 style="color:white; font-size:30px">Check, if you want a public attribute</h4>
<form action="php_files/security_database_page.php" method="post">
<?php
if (isset($_GET["security"]) && $_GET["security"] == 'successfull') {
	echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Your security settings has changed!
  </div></p>';
}
if (isset($_GET["security"]) && $_GET["security"] == 'notsuccessfull') {
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Your security settings has\'nt changed!
  </div></p>';
}
$cookie_name = "justdontforgettheusername";

if(isset($_COOKIE[$cookie_name]))
{
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ./index.php");}
	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db($dbname,$conn);
	
	mysql_query("SET NAMES UTF8");	
	
	$qry = "SELECT * FROM security_users";
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result)){
		if($fnev == $row[0])
		{
			if($row[1] == 1)
			{
				echo '<div><label for="mylastname">My first name</label>&nbsp;<input id="mylastname" type="checkbox" name="mylastname" checked value="1"></div>';
			}
			else
			{
				echo '<div><label for="mylastname">My first name</label>&nbsp;<input id="mylastname" type="checkbox" name="mylastname" value="1"></div>';
			}
			if($row[2] == 1)
			{
				echo '<div><label for="myfirstname">My last name</label>&nbsp;<input id="myfirstname" type="checkbox" name="myfirstname" checked value="1"></div>';
			}
			else
			{
				echo '<div><label for="myfirstname">My last name</label>&nbsp;<input id="myfirstname" type="checkbox" name="myfirstname" value="1"></div>';
			}
			if($row[3] == 1)
			{
				echo '<div><label for="myemail">E-Mail</label>&nbsp;<input id="myemail" type="checkbox" name="myemail" checked value="1"></div>';
			}
			else
			{
				echo '<div><label for="myemail">E-Mail</label>&nbsp;<input id="myemail" type="checkbox" name="myemail" value="1"></div>';
			}
			if($row[4] == 1)
			{
				echo '<div><label for="myborndate">Born of date</label>&nbsp;<input id="myborndate" type="checkbox" name="myborndate" checked value="1"></div>';
			}
			else
			{
				echo '<div><label for="myborndate">Born of date</label>&nbsp;<input type="checkbox" id="myborndate" name="myborndate" value="1"></div>';
			}
			if($row[5] == 1)
			{
				echo '<div><label for="myprofilepicture">My profile picture</label>&nbsp;<input type="checkbox" name="myprofilepicture" id="myprofilepicture" checked value="1"></div>';
			}
			else
			{
				echo '<div><label>My profile picture</label>&nbsp;<input type="checkbox" name="myprofilepicture" value="1"></div>';
			}
			if($row[8] == 1)
			{
				echo '<div><label for="hashtagemail">Get email if anyone create an event with your hashtag</label>&nbsp;<input id="hashtagemail" type="checkbox" name="hashtagemail" checked value="1"></div>';
			}
			else
			{
				echo '<div><label for="hashtagemail">Get email if anyone create an event with your hashtag</label>&nbsp;<input type="checkbox" id="hashtagemail" name="hashtagemail" value="1"></div>';
			}
			if($row[6] == 1)
			{
				echo '<div><img border="0" width="50" height="50" src="images/Facebook.png">&nbsp;<input type="checkbox" name="myfacebookprofile" id="myfacebookprofile" checked value="1"></div>';
			}
			else
			{
				echo '<div><img border="0" width="50" height="50" src="images/Facebook.png">&nbsp;<input type="checkbox" name="myfacebookprofile" id="myfacebookprofile" value="1"></div>';
			}
			if($row[7] == 1)
			{
				echo '<div><img border="0" width="50" height="50" src="images/Twitter.png">&nbsp;<input type="checkbox" id="mytwitterprofile" name="mytwitterprofile" checked value="1"></div>';
			}
			else
			{
				echo '<div><img border="0" width="50" height="50" src="images/Twitter.png">&nbsp;<input type="checkbox" id="mytwitterprofile" name="mytwitterprofile" value="1"></div>';
			}
		}
	}
}
else
{
	header("Location: ./index.php");
}
?>
<button type="submit" class="buttonshadow">Edit my security settings</button>
</form>
</div>
<?php
impress();
?>
</body>
</html>