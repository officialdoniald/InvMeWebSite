<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User description</title>
        <link rel="icon" href="../images/logo.jpg">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="../css_style/elemtns_css.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/functions.js"></script>
</head>

<body onLoad="onlo()">
<div align="center">
  <?php 
  require 'labels/labels.php';
  menubar();
  ?>
</div>
<div align="center"><br>
<?php
	$list = $_GET["list"];
	
	$listev = $_GET["listev"];

	$user = $_GET["username"];
	
	$cookie_name = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_name];
	if($fnev == ""){header("Location: ../index.php");}
	
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$qry = "SELECT * FROM security_users";
	
	$result = mysql_query($qry,$conn);
	
	$security = array();
	
	while($row = mysql_fetch_array($result))
	{
		if($user == $row[0])
		{
			$security[0] = $row[1];
			$security[1] = $row[2];
			$security[2] = $row[3];
			$security[3] = $row[4];
			$security[4] = $row[5];
			$security[5] = $row[6];
			$security[6] = $row[7];
		}
	}
	$qry = "SELECT * FROM users";
	
	mysql_query("SET NAMES UTF8");
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($user == $row[0])
		{
			echo 
			'
			<div>
			<input name="ismobile" id="ismobile" type="text" value="no" hidden="true">
			<input name="filesize" id="filesize" type="text" value="'.$row[9].'" hidden="true">
			<label>Username: '.$user.'</label>';
			if($security[4] == 1)
			{
				if($row[6] == NULL)
				{
					echo '<br><label>No profile picture!</label><br>';
				}
				else
				{
					echo '<div>
            				<img id="picture"  height="300" width="300" class="img-circle" src="data:image/jpeg;base64,'.$row[6].'">
					</div>';
				}
			}
			if($security[0] == 1)
			{
				echo '<br><label>Last name: '.$row[1].'</label><br>';
			}
			if($security[1] == 1)
			{
				echo '<label>First name: '.$row[2].'</label><br>';
			}
			if($security[2] == 1)
			{
				echo '<label>E-mail: '.$row[4].'</label><br>';
			}
			if($security[3] == 1)
			{
				echo '<label>Date of born: '.$row[5].'</label><br>';
			}
			if($security[5] == 1 && $row[7] != "")
			{
				echo '<a href="'.$row[7].'"><img border="0" width="50" height="50" src="../images/Facebook.png"></a>';
			}
			if($security[6] == 1 && $row[8] != "")
			{
				echo '<a href="'.$row[8].'"><img border="0" width="50" height="50" src="../images/Twitter.png"></a><br><br>';
			}
				
				
				if($user != $fnev){
				
					$qry = "SELECT * FROM friends";
		
					$result = mysql_query($qry,$conn);
					
					$valami = 0;
					
					while($row = mysql_fetch_array($result))
					{
						if($row[1] == $user && $row[0] == $fnev)
						{
							echo '
						<form method="post" action="delete_friend.php">
						<input hidden="true" type="text" name="friend" value="'.$user.'">
						<input hidden="true" type="text" name="list" value="'.$list.'">
						<input hidden="true" type="text" name="listev" value="'.$listev.'">
						<button class="buttonshadow" type="submit">Delete friend</button><br><br>
						</form>';
							$valami = 1;
						}
					}
					if($valami == 0)
					{
						echo'
							<form method="post" action="friend_request.php">
							<input hidden="true" type="text" name="friend" value="'.$user.'">
							<input hidden="true" type="text" name="list" value="'.$list.'">
						<input hidden="true" type="text" name="listev" value="'.$listev.'">
							<button class="buttonshadow" type="submit">Add friend</button><br><br>
							</form>';
					}
				}
				echo'</div>';
			mysql_close($conn);
		}
	}
	
?>
</div>
<?php
impress();
?>
</body>
</html>