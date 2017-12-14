<!doctype html>
<html>
<head>
<title>Inv me!</title>
<meta charset="utf-8">
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
<br>
<?php
$cookie_nameq = "justdontforgettheusername";
$cookie_name = "user";

if(!isset($_COOKIE[$cookie_name]) && isset($_GET["loginsuccessT"])) {
	$fnev = $_GET["loginsuccessT"];
	$cookie_value = $fnev;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  setcookie("justdontforgettheusername", $cookie_value, time() + (86400 * 30), "/");
  setcookie("justthenavigation", "yes", time() + (86400 * 30), "/");
}
else if (isset($_GET["loginsuccess"])) 
{
$fnev = $_GET["loginsuccess"];
$cookie_value = $fnev;
setcookie("justdontforgettheusername", $cookie_value, time() + (86400 * 30), "/");
  setcookie("justthenavigation", "yes", time() + (86400 * 30), "/");
}else if(isset($_GET["justthenavigation"]) && $_GET["justthenavigation"] == "yes"){
  header("Location: php_files/logout.php");
}
if (isset($_GET["eventcreate"]) && $_GET["eventcreate"] == 'okay') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> We created the event!
  </div></p>';
}
if (isset($_GET["eventcreate"]) && $_GET["eventcreate"] == 'notokay') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Opps!</strong> We can\'nt created the event!
  </div></p>';
}
?>
<br>
<div class="container">
  <div class="row">
    <div class="col-sm-4" style="text-align:center;">
      <br><label style="color:white; font-size:36px;">List events</label><br>
      <form action="list_events.php" method="post">
        <input id="inputname" type="text" name="contains_event"><br>
        <label id="labelname" style="color:white; font-size:20px">Event name</label><br>
        <input id="inputtown" type="text" name="town"><br>
        <label id="labeltown" style="color:white; font-size:20px">Town/Online</label><br>
        <button class="buttonshadow" type="submit">List events</button>
      </form>
    </div>
    <div class="col-sm-4" style="text-align:center;">
      <br><label style="color:white; font-size:36px">Create event</label><br>
      <label style="color:white; font-size:25px">
      <br>You can create a new event.<br><br><br>
      </label>
      <form action="create_event.php">
        <button class="buttonshadow" type="submit">Create event</button>
      </form>
    </div>
    <div class="col-sm-4" style="text-align:center;">
      <br><label style="color:white; font-size:36px">Profile edit</label><br>
      <label style="color:white; font-size:25px">
     <br>You can edit your profile.<br><br><br>
      </label>
      <form action="profile_edit_page.php">
        <button class="buttonshadow" type="submit">My profile</button>
      </form>
    </div>
  </div>
</div>
<br><br><?php
impress();
?>
</body>
</html>
