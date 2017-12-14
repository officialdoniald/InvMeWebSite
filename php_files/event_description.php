<!doctype html>
<html>
<head>
<title>Event decription</title>
        <link rel="icon" href="../images/logo.jpg">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
  <?php
  	
	if (isset($_GET["friend"]) && $_GET["friend"] == 'okay') {
	echo '<p><div class="alert alert-success">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Done!</strong> Added as a friend!
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
		<strong>Done!</strong> We have removed!
	  </div></p>';
	}
	if (isset($_GET["friend"]) && $_GET["friend"] == 'notdeleted') {
	echo '<p><div class="alert alert-alert">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Oops!</strong> Something went wrong, please check back soon!
	  </div></p>';
	}
	
	$eventname = $_GET["eventname"];
	
	$pieces = explode("_", $eventname);
	
	$eventname = $pieces[0];
	$id = $pieces[1];
	
	if($eventname == "")
	{
		$eventname = $_COOKIE["lastselectedevent"];
	}else{
		setcookie("lastselectedevent", $id,time()+(86400 * 30), '/');
	}
	
	$cookie_name = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_name];
	if($fnev == ""){header("Location: ../index.php");}
if (isset($_COOKIE["lastselectedevent"]) || isset($_GET["eventname"])) {
	
	$conn = mysql_connect($servername, $username, $password);

	mysql_select_db($dbname,$conn);
	
	mysql_query("SET NAMES UTF8");	
	
	$qry = "SELECT * FROM events";
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($row[0] == $id)
		{
			echo 
			'
	<input hidden="true" type="text" id="tal_longitude_input" value="'.$row[8].'" name="tal_longitude_input">
    <input hidden="true" type="text" id="tal_lattitude_input" value="'.$row[9].'" name="tal_lattitude_input">
    <input hidden="true" type="text" id="ahol_longitude_input" value="'.$row[10].'" name="ahol_longitude_input">
    <input hidden="true" type="text" id="ahol_lattitude_input" value="'.$row[11].'" name="ahol_lattitude_input">
				<br><p id="val"><label style="color:white;font-weight:bold;font-size:40px;">'.$eventname.'</label>
				';
				if ($row["online"] != "yesonline") {
					echo '<br><label style="color:white;font-weight:bold;font-size:30px;">'.$row[3].', '.$row[4].'</label></p>';
				}else{
					echo '<br><label style="color:white;font-weight:bold;font-size:30px;">online</label></p>';
				}
				if($row[13] != 'n'){
				$fromwhentowhen = explode(".",$row[2]);
				$y1 = $fromwhentowhen[0];
				$m1 = $fromwhentowhen[1];
				$m1 = saythemonth($m1);
				$d1 = $fromwhentowhen[2];
				$d1 = zerotonull($d1);
				$h1 = $row[12];
				$fromwhentowhen2 = explode(".",$row[13]);
				$y2 = $fromwhentowhen2[0];
				$m2 = $fromwhentowhen2[1];
				$m2 = saythemonth($m2);
				$d2 = $fromwhentowhen2[2];
				$d2 = zerotonull($d2);
				$h2 = $row[14];
				echo '<table class="table" style="background:none;">
					  <td align="center" style="border:0px;"><p id="val">
					  <label>'.$m1.'&nbsp;'.$y1.'</label><br>
					  <label style="font-size:50px;">'.$d1.'</label><br>
					  <label>'.$h1.'</label></p>
					  </td>
					  <td align="center" style="border:0px;"><p id="val">
					  <label>'.$m2.'&nbsp;'.$y2.'</label><br>
					  <label style="font-size:50px;">'.$d2.'</label><br>
					  <label>'.$h2.'</label></p>
					  </td>
					  </table>';
			}else{
				$fromwhentowhen = explode(".",$row[2]);
				$y1 = $fromwhentowhen[0];
				$m1 = $fromwhentowhen[1];
				$m1 = saythemonth($m1);
				$d1 = $fromwhentowhen[2];
				$d1 = zerotonull($d1);
				$h1 = $row[12];
				echo '<table class="table" style="background:none;">
					  <td align="center" style="border:0px;width=*;"><p id="val">
					  <label>'.$m1.'&nbsp;'.$y1.'</label><br>
					  <label style="font-size:50px;">'.$d1.'</label><br>
					  <label>'.$h1.'</label></p>
					  </td>
					  <td align="center" style="border: 0px;"><p id="val">
					  <label>no matter</label></p>
					  </td>
					  </table>';
			}
			if ($row["online"] != "yesonline") {
				echo '<p id="val"><label style="font-size:25px">When and where meet:</label><br><label>'.$row[7].'</label></p>';
			}
				echo '
				'.nl2br('<p id="val"><label style="font-size:25px">Description: </label><br><label accept-charset="UTF-8">'.$row[6].'</label></p>').'
			';
			if ($row["online"] != "yesonline") {
				echo'<br><label style="font-size:25px">Where is the meeting point:</label><br><div id="map" style="width:300px;height:300px"></div><br>';
				echo'<label style="font-size:25px">Where is the party point:</label><br><div id="map2" style="width:300px;height:300px"></div><br>';
			}
			break;
		}
	}
	
	$jogosul_e = false;
	
	$qry = "SELECT * FROM whos";
		
	$result = mysql_query($qry,$conn);
		
		while($row = mysql_fetch_array($result))
		{
			if($row[1] == $id)
			{
				if($row[0] == $fnev)
				{
					if(isset($_GET["list"]) == "aha")
					{
						$valt = $_GET["list"];
						echo '<br><br><form method="post" action="unsubscribe_from_the_event.php">
						<input hidden="true" type="text" name="lis" value="'.$valt.'">
						<button type="submit" class="buttonshadow">Unsubscribe from the event</button></form>';
					}
					else
					{
						echo '<br><br><form action="unsubscribe_from_the_event.php">
						<button type="submit" class="buttonshadow">Unsubscribe from the event</button></form>';
					}
				}
			}
		}
		echo'<br><label style="font-size:25px">Who already attend:</label>';
		
		
		
		$result = mysql_query($qry,$conn);
		while($row = mysql_fetch_array($result))
		{
			if($row[1] == $id)
			{
				echo 
				'					
					<br>
					<a style="color:white;" href="user_description.php?username='.utf8_encode($row[0]).'&listev=aha">';
				
					$qry2 = "SELECT * FROM users";
					$result2 = mysql_query($qry2,$conn);
				
					while($row1 = mysql_fetch_array($result2))
					{
						if($row1[0] == $row[0])
						{
							$qry = "SELECT * FROM security_users";
								
							$result22 = mysql_query($qry,$conn);
								
							$pic == 0;
								
							while($row22 = mysql_fetch_array($result22))
							{
								if($row22[0] == $row[0])
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
				echo '&nbsp;&nbsp;&nbsp;'.$row[0].'</a>';
			}
		}
		echo '</h4>';
}
else
{
	header("Location: ../index.php");
}
?>
<script>
function initMap() {
	var placelat = document.getElementById("tal_lattitude_input").value;
	var placelong = document.getElementById("tal_longitude_input").value;
	var meetlat = document.getElementById("ahol_lattitude_input").value;
    var meetlong = document.getElementById("ahol_longitude_input").value;
	  
  var myCenter = new google.maps.LatLng(placelat,placelong);
  var myCenter2 = new google.maps.LatLng(meetlat,meetlong);
  var mapCanvas = document.getElementById("map");
  var mapCanvas2 = document.getElementById("map2");
  var mapOptions = {center: myCenter, zoom: 7};
  var mapOptions2 = {center: myCenter2, zoom: 7};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var map2 = new google.maps.Map(mapCanvas2, mapOptions2);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
  var marker2 = new google.maps.Marker({position:myCenter2});
  marker2.setMap(map2);
var infowindow2 = new google.maps.InfoWindow({
		content: 'Here is the party point.'
	  });
	  infowindow2.open(map2,marker2);
	  var infowindow = new google.maps.InfoWindow({
		content: 'Here is the meeting point.'
	  });
	  infowindow.open(map,marker);
  // Zoom to 9 when clicking on marker
  google.maps.event.addListener(marker,'click',function() {
    map.setZoom(15);
    map.setCenter(marker.getPosition());
  });
  
  google.maps.event.addListener(marker2,'click',function() {
    map2.setZoom(15);
    map2.setCenter(marker2.getPosition());
  });
}

</script>

<script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtqi-xZkn_ayp5g0ypNg1T-aAGkDQBwno&callback=initMap"></script>

</div>
<?php
impress();
?>
</body>
</html>