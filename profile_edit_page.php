<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<title>Profile</title>
        <link rel="icon" href="images/logo.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
</head>

<body onLoad="onlo()">
<div align="center">
<?php 
  require 'php_files/labels/labels.php';
  menubar();
  ?> 
</div>
<?php
$cookie_name = "justdontforgettheusername";

if (isset($_GET["updatepicture"]) && $_GET["updatepicture"] == 'successfull') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Your profile picture has changed!
  </div></p>';
}
if (isset($_GET["updatepicture"]) && $_GET["updatepicture"] == 'error') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Your profile picture has\'nt changed!
  </div></p>';
}
if (isset($_GET["updatepassword"]) && $_GET["updatepassword"] == 'successfull') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Your password has changed!
  </div></p>';
}
if (isset($_GET["updatepassword"]) && $_GET["updatepassword"] == 'error') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Your password has\'nt changed!
  </div></p>';
}
if (isset($_GET["updateprofile"]) && $_GET["updateprofile"] == 'successfull') {
	echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Your profile has changed!
  </div></p>';
}
if (isset($_GET["updateemail"]) && $_GET["updateemail"] == 'successfull') {
	echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Please check your emails and confirm the new email adress!
  </div></p>';
}
if (isset($_GET["updateprofile"]) && $_GET["updateprofile"] == 'error') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Your profile has\'nt changed!
  </div></p>';
}

if(isset($_COOKIE[$cookie_name]))
{
	
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ./");}
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$qry = "SELECT * FROM users";
	
	mysql_query("SET NAMES UTF8");	
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($fnev == $row[0])
		{
			echo 
			'
			<div align="center">
			<h1 style="font-size:36px;font:bold;color:white;">My profile</h1><br><br>
				';
				if($row[9] > 0){
					echo '<p><img id="picture" height="300" width="300" class="img-circle" src="data:image;base64,'.$row[6].'"></p>';
					}else{
						echo '<label>No profile picture!</label><br>';
						}
				echo '<br>
			<input class="rotate90" name="ismobile" id="ismobile" type="text" value="no" hidden="true">
			<input name="filesize" id="filesize" type="text" value="'.$row[9].'" hidden="true">
				<form action="php_files/update_profile.php">
				<p><label>Username: </label><br><label>'.$fnev.'</label></p>
				<p><label>Last name: </label><br><label> '.$row[1].'</label></p>
				<p><label>First name: </label><br><label> '.$row[2].'</label></p>
				<p><label>E-mail: </label><br><label> '.$row[4].'</label></p>
				<p><label>Date of born: </label><br><label> '.$row[5].'</label></p>
				<p><a href="'.$row[7].'"><img border="0" width="50" height="50" src="images/Facebook.png"></a></p>
				<p><a href="'.$row[8].'"><img border="0" width="50" height="50" src="images/Twitter.png"></a></p>
				<p><button type="submit" class="buttonshadow">Edit my profile</button></p>
				</form>
			</div>
			';
			mysql_close($conn);
		}
	}
}
else
{
header("Location: ./index.php");
}
?>
<?php
impress();
?>
</body>
</html>