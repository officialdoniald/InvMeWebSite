<!DOCTYPE html>
<html><head>
        <title>Inv me!</title>
        <link rel="icon" href="images/logo.jpg">
        <meta charset="UTF-8">
        <link rel="icon" href="http://example.com/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="cent">
	<h1 style="color:white">Inv me!</h1>
<?php
$cookie_name = "user";
if(isset($_COOKIE[$cookie_name])) {
    header("Location: main_page.php");
}
if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Wrong username/password!
  </div></p>';
}
if (isset($_GET["token"]) && $_GET["token"] == 'confirmrequired') {
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Please check your emails and confirm this account!
  </div></p>';
}
if(isset($_GET["errorwiththedatabase"]) && $_GET["errorwiththedatabase"] == 'failed'){
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please check back soon!
  </div></p>';
}
if (isset($_GET["regsecuessfull"]) && $_GET["regsecuessfull"] == 'okay') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Successfull registration! Please confirm your e-mail!
  </div></p>';
}
if (isset($_GET["regsecuessfull"]) && $_GET["regsecuessfull"] == 'notokay') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Registration failed, please try again!
  </div></p>';
}
if (isset($_GET["emailsuccess"]) && $_GET["emailsuccess"] == 'success') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> Check your new password in your emails!
  </div></p>';
}
if (isset($_GET["wrongusernameorpassword"]) && $_GET["wrongusernameorpassword"] == 'wrong') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Wrong username/password!
  </div></p>';
}
if (isset($_GET["changeemail"]) && $_GET["changeemail"] == 'successfull') {
	echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> You can now login!
  </div></p>';
}
if (isset($_GET["dbexception"]) && $_GET["dbexception"] == 'error') {
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please check back later!
  </div></p>';
}
if (isset($_GET["mustlogin"]) && $_GET["mustlogin"] == 'true') {
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> You must login first!
  </div></p>';
}
if (isset($_GET["tokenconfirm"]) && isset($_GET["user"])) {
	require 'php_files/labels/labels.php';
	
	$token = $_GET["tokenconfirm"];
	$usename = $_GET["user"];
	
	$conn = mysql_connect($servername, $username, $password);
	
	$qry = "SELECT * FROM users";
	
	mysql_select_db($dbname,$conn);
	
	$result = mysql_query($qry,$conn);
	
	$goodtoken = false;
	
	while($row = mysql_fetch_array($result))
	{
		if($usename == $row[0] && $token == $row[10])
		{
			$goodtoken = true;
			break;
		}
	}
	
	if ($goodtoken == true){
		
		$qry = "UPDATE users SET confirm='okay' WHERE username='".$usename."'";
			
		$result = mysql_query($qry,$conn);
			
		if($result == 1)
		{
			echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> You can now login!
  </div></p>';
		}
		else
		{
			echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Something went wrong, please check back later!
  </div></p>';
		}
	}else{
		echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Wrong token or username!
  </div></p>';
	}
}
?>
            <form action="php_files/login.php" method="post">           
                <input type="text" required name="fnev"><br><label>Username</label> <br><br>
                <input type="password" required name="pw"><br><label>Password</label>
                <br><br>   
                <input style="background:none" type="checkbox" value="1" id="dontforgetme" name="dontforgetme"><label for="dontforgetme">&nbsp;Remember me</label><br><br>
                <button class="buttonshadow" type="submit">Sign In</button><br><br> 
                <a style="color:white" href="forgot_password.php">Forgot password</a><br>
            </form>
            <h2 style="color:white">Sign Up</h2>
            <form action="registration_page.php">
				<button class="buttonshadow" type="submit">Sign Up</button><br>
            <div><a style="color:white;" href="impress2.html">Impress</a></div>
			</form>
        </div>
    </body>
</html>