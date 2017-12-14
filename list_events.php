<!doctype html>
<html>
<head>
<title>List events</title>
        <link rel="icon" href="images/logo.jpg">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<div align="center" style="text-align:center">
	<form action="list_events.php" method="post">
        <input type="text" name="contains_event"><br>
        <label>Event name</label><br>
        <input type="text" name="town"><br>
        <label>Town/Online</label><br>
        <button type="submit" class="buttonshadow">List events</button>
     </form>
</div>
<br>
<div align="center">
<?php

$search_event = $_POST["contains_event"];
if($search_event == ""){
	$search_event = $_GET["contains_event"];
}
$search_town = $_POST["town"];

if (isset($_GET["apply_event"]) && $_GET["apply_event"] == 'okay') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Done!</strong> You signed up for the event!
  </div></p>';
}
if (isset($_GET["apply_event"]) && $_GET["apply_event"] == 'notokay') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> You not signed up for the event!
  </div></p>';
}
if (isset($_GET["apply_event"]) && $_GET["apply_event"] == 'exists') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Already participating in the event!
  </div></p>';
}
if (isset($_GET["un"]) && $_GET["un"] == 'yes') {
echo '<p><div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Done!</strong> You signed off on the event!
  </div></p>';
}
if (isset($_GET["un"]) && $_GET["un"] == 'no') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> You not signed off on the event!
  </div></p>';
}

echo '<div class="container"><br>';

$t=time();

$date = date("Y.m.d.",$t);
$timme = date("H:i", $t);

$cookie_name = "justdontforgettheusername";

if(isset($_COOKIE[$cookie_name]))
{
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ./");}
	$conn = mysql_connect($servername, $username, $password);

	$breakrow = 1;

	mysql_select_db($dbname,$conn);
	
	mysql_query("SET NAMES UTF8");	
	
	$qry = "SELECT * FROM events order by event_time asc";
	
	$result = mysql_query($qry,$conn);
	
	$many = array();
	
	while($row = mysql_fetch_array($result)){
		$many[$row[0]] = 0;
	}
	
	$qry = "SELECT * FROM whos";
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		foreach($many as $x => $x_value) 
		{
			if($x == $row[1])
			{
				$many[$x]++;
			}
		}
	}
	
	$qry = "SELECT * FROM events order by event_time asc";
	
	$result = mysql_query($qry,$conn);
	
	$value = "";

	while($row = mysql_fetch_array($result)){
		foreach($many as $x => $x_value) 
		{
			if($x == $row[0])
			{
				$value = $x_value;
			}
			
		}
		
		$val = "";
		
		if($row[5] == ""){
			$val = "Anyone";
		}
		else
		{
			$val = $row[5];
		}
		if((strpos(strtolower($row[1]),strtolower($search_event)) !== false || $search_event == "") &&
		(
		(strtolower($row[3])==strtolower($search_town)) || 
		($search_town=="" && strpos(strtolower($row[1]),strtolower($search_event)) !== false) ||
		($search_town=="" && $search_town == "")
		) &&
		$date <= $row[2] || ($date == $row[13] && $timme <= $row[14])
		){
			$breakrow++;
		if ($breakrow == 4) {
			echo'<div class="row">';
		}
		echo'
    <div class="col-sm-4" style="text-align:center;"><p id="val">
		<a style="color:white;font-weight:bold;font-size:30px;" href="php_files/event_description.php?eventname='.$row[1].''.'_'.''.$row[0].'">'.$row[1].'</a>';
			if ($row["online"] == "yesonline") {
				echo '<br><label>online</label><br>';
			}else{
				echo '<br><label>'.$row[3].', '.$row[4].'</label><br>';
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
					  <td align="center" style="border:0px;width=*;"><p id="val">
					  <label>'.$m1.'&nbsp;'.$y1.'</label><br>
					  <label style="font-size:50px;">'.$d1.'</label><br>
					  <label>'.$h1.'</label></p>
					  </td>
					  <td align="center" style="border:0px;width=*;"><p id="val">
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
			echo'
			<label>'.$val.' / '.$value.'</label><br>';
		if($val == "Anyone"){
			echo '<form action="php_files/apply_event.php" method="post"><input type="text" hidden="true" name="eventnamed" value="'.$row[0].'"><button class="buttonshadow" type="submit">Inv me!</button></form><br><br></div>';}
		else if($value < $row[5])
		{
		echo '<form action="php_files/apply_event.php" method="post"><input type="text" hidden="true" name="eventnamed" value="'.$row[0].'"><button class="buttonshadow" type="submit">Inv me!</button></form><br><br></div>';
		}
		else{echo '</div>';} 

		if ($breakrow == 4) {
			echo'</div>';
			$breakrow = 1;
		}
		}
	}
}
else
{
	header("Location: ./index.php");
}
?>
  </table>
</div>
<br><br>
<?php
impress();
?>
</body>
</html>