<!doctype html>
<html>
<head>
<meta charset="utf-8">
		<title>My friends</title>
        <link rel="icon" href="../images/logo.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="../css_style/elemtns_css.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/functions.js"></script>
</head>
<body>
 <div align="center">
  <?php 
  require 'labels/labels.php';
  menubar();
  ?>
</div>
<div align="center">
<label style="font-size:36px">My friends</label><br><br>
 <?php
  if (isset($_GET["friend"]) && $_GET["friend"] == 'okay') {
	echo '<p><div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Done!</strong> Added as friend!
	  </div></p>';
	}
	if (isset($_GET["friend"]) && $_GET["friend"] == 'notokay') {
	echo '<p><div class="alert alert-alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Oops!</strong> Something went wrong, please check back soon!
	  </div></p>';
	}
	if (isset($_GET["friend"]) && $_GET["friend"] == 'deleted') {
	echo '<p><div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Done!</strong> Deleted from your friends!
	  </div></p>';
	}
	if (isset($_GET["friend"]) && $_GET["friend"] == 'notdeleted') {
	echo '<p><div class="alert alert-alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Oops!</strong> Something went wrong, please check back soon!
	  </div></p>';
	}
	$cookie_name = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_name];
if($fnev == ""){header("Location: ../index.php");}
	$eventname = $_GET["eventname"];
	
	if(isset($_COOKIE["lastselectedevent"]))
	{
		$eventname = $_COOKIE["lastselectedevent"];
	}
	else if(isset($_GET["eventname"]) && !isset($_COOKIE["lastselectedevent"]))
	{
		setcookie("lastselectedevent", $eventname,time()+(86400 * 30), '/');
	}
	
	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db($dbname,$conn);
	
	$qry = "SELECT * FROM friends";
	
	$result = mysql_query($qry,$conn);

	while($row = mysql_fetch_array($result))
	{
		if($row[0] == $fnev)
		{
			echo'<a style="color:white;" href="user_description.php?username='.utf8_encode($row[1]).'&list=aha">';
			
			$qry2 = "SELECT * FROM users";
			$result2 = mysql_query($qry2,$conn);
			
			while($row1 = mysql_fetch_array($result2))
			{
				if($row1[0] == $row[1])
				{
					$qry = "SELECT * FROM security_users";
					
					$result22 = mysql_query($qry,$conn);
					
					$pic == 0;
					
					while($row22 = mysql_fetch_array($result22))
					{
						if($row22[0] == $row[1])
						{
							$pic = $row22[5];
						}
					}

					if (isMobile()){
						if($pic == 1 && $row1[9] == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else if($pic == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else if($row1[9] == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else{
							echo '<img height="50" width="50" class="img-circle" src="data:image;base64,'.$row1[6].'">';
						}
					}
					else{
						if($pic == 1 && $row1[9] == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else if($pic == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else if($row1[9] == 0){
							echo '<img height="50" width="50" class="img-circle" src="../images/User.png">';
						}else{
							if($row1[9] >= 140000 && $row1[9] < 919358){
								echo '<img height="50" width="50" class="img-circle rotate90" src="data:image;base64,'.$row1[6].'">';
							}
							else if($row1[9] >= 919358 && $row1[9] < 1240228){
								echo '<img height="50" width="50" class="img-circle rotate180" src="data:image;base64,'.$row1[6].'">';
							}else{
								echo '<img height="50" width="50" class="img-circle" src="data:image;base64,'.$row1[6].'">';
							}
						}
					}
				}
			}
			echo '&nbsp;&nbsp;&nbsp;'.utf8_encode($row[1]).'</a><br>';
		}
	}
?>
</div>
<br><?php
 impress();
 ?>
</body>
</html>