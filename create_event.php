<!doctype html>
<html>
<head>
<title>Inv me! Create event</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/logo.jpg">
<link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>
</head>

<body>
<?php
$cookie_nameq = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_nameq];
	if($fnev == ""){header("Location: ./");}
	
	
    if (isset($_GET["map"]) && $_GET["map"] == 'not') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Please</strong>, mark on the map the party and the meeting points!
  </div></p>';
}
if (isset($_GET["date"]) && $_GET["date"] == 'not') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Please</strong>, remind, the second date(end of the event) is later or equal then the first!
  </div></p>';
}
?>
<div align="center">
<?php 
  require 'php_files/labels/labels.php';
  menubar();
  ?> 
</div>
<div align="center">
  <label style="font-size:36px">Event create</label><br><br>
  <form onSubmit="return checkSubmit()" method="post" action="php_files/create_events.php">
    <input required type="text" name="event_name"><br><label>Event name</label><br><br>
    <textarea class="textarea" required name="description"></textarea><br><label>Event description</label><br>
<label hidden="true" id="changefirst" style="color:red;">You must change the first date or the second date!</label><br>
<label hidden="true" id="changetime" style="color:red;">You must change the time!<br></label>
<label hidden="true" id="future" style="color:red;">You must change the date, you can't create an event with future date.</label>
    <br>
    <label>from</label><br><select class="select" onChange="eventchangeYear()" required id="year">
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select> 
            <select class="select" onChange="eventchangeMonth()" required id="month">
            	<option value="01">January</option>
            	<option value="02">February</option>
            	<option value="03">March</option>
            	<option value="04">April</option>
            	<option value="05">May</option>
            	<option value="06">June</option>
            	<option value="07">July</option>
            	<option value="08">August</option>
            	<option value="09">September</option>
            	<option value="10">Oktober</option>
            	<option value="11">November</option>
            	<option value="12">December</option>
            </select>
            <select class="select" onChange="eventchangeDay()" required id="day">
            	<option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select>
            <input hidden="true" type="text" id="event_time" value="2016.01.01." name="event_time"><br>
            <select class="select" required onchange="changetime()" id="hour" name="hour">
            	<option value="0">0</option>
            	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            	<option value="4">4</option>
            	<option value="5">5</option>
            	<option value="6">6</option>
            	<option value="7">7</option>
            	<option value="8">8</option>
            	<option value="9">9</option>
            	<option value="10">10</option>
            	<option value="11">11</option>
            	<option value="12">12</option>
            	<option value="13">13</option>
            	<option value="14">14</option>
            	<option value="15">15</option>
            	<option value="16">16</option>
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            	<option value="21">21</option>
            	<option value="22">22</option>
            	<option value="23">23</option>
            </select><label>:</label><select onchange="changetime()" class="select" required id="minute" name="minute">
            	<option value="00">00</option>
            	<option value="01">01</option>
            	<option value="02">02</option>
            	<option value="03">03</option>
            	<option value="04">04</option>
            	<option value="05">05</option>
            	<option value="06">06</option>
            	<option value="07">07</option>
            	<option value="08">08</option>
            	<option value="09">09</option>
            	<option value="10">10</option>
            	<option value="11">11</option>
            	<option value="12">12</option>
            	<option value="13">13</option>
            	<option value="14">14</option>
            	<option value="15">15</option>
            	<option value="16">16</option>
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            	<option value="21">21</option>
            	<option value="22">22</option>
            	<option value="23">23</option>
            	<option value="24">24</option>
            	<option value="25">25</option>
            	<option value="26">26</option>
            	<option value="27">27</option>
            	<option value="28">28</option>
            	<option value="29">29</option>
            	<option value="30">30</option>
            	<option value="31">31</option>
            	<option value="32">32</option>
            	<option value="33">33</option>
            	<option value="34">34</option>
            	<option value="35">35</option>
            	<option value="36">36</option>
            	<option value="37">37</option>
            	<option value="38">38</option>
            	<option value="39">39</option>
            	<option value="40">40</option>
            	<option value="41">41</option>
            	<option value="42">42</option>
            	<option value="43">43</option>
            	<option value="44">44</option>
            	<option value="45">45</option>
            	<option value="46">46</option>
            	<option value="47">47</option>
            	<option value="48">48</option>
            	<option value="49">49</option>
            	<option value="50">50</option>
            	<option value="51">51</option>
            	<option value="52">52</option>
            	<option value="53">53</option>
            	<option value="54">54</option>
            	<option value="55">55</option>
            	<option value="56">56</option>
            	<option value="57">57</option>
            	<option value="58">58</option>
            	<option value="59">59</option>
            </select><br><label>to</label><br><input type="checkbox" id="nomatter" name="nomatter" onchange="nomatter1()" value="matter"></input><label for="nomatter">&nbsp;no matter how long</label><br>
            <select class="select" onChange="eventchangeYear2()" required id="year2">
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select> 
            <select class="select" onChange="eventchangeMonth2()" required id="month2">
            	<option value="01">January</option>
            	<option value="02">February</option>
            	<option value="03">March</option>
            	<option value="04">April</option>
            	<option value="05">May</option>
            	<option value="06">June</option>
            	<option value="07">July</option>
            	<option value="08">August</option>
            	<option value="09">September</option>
            	<option value="10">Oktober</option>
            	<option value="11">November</option>
            	<option value="12">December</option>
            </select>
            <select class="select" onChange="eventchangeDay2()" required id="day2">
            	<option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
            </select><br>
            <input hidden="true" type="text" id="event_time2" value="2016.01.01." name="event_time2">
            <select class="select" onchange="changetime()" required id="to_hour" name="to_hour">
            	<option value="0">0</option>
            	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            	<option value="4">4</option>
            	<option value="5">5</option>
            	<option value="6">6</option>
            	<option value="7">7</option>
            	<option value="8">8</option>
            	<option value="9">9</option>
            	<option value="10">10</option>
            	<option value="11">11</option>
            	<option value="12">12</option>
            	<option value="13">13</option>
            	<option value="14">14</option>
            	<option value="15">15</option>
            	<option value="16">16</option>
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            	<option value="21">21</option>
            	<option value="22">22</option>
            	<option value="23">23</option>
            </select><label id="kettospont">:</label><select class="select" onchange="changetime()" required id="to_minute" name="to_minute">
            	<option value="00">00</option>
            	<option value="01">01</option>
            	<option value="02">02</option>
            	<option value="03">03</option>
            	<option value="04">04</option>
            	<option value="05">05</option>
            	<option value="06">06</option>
            	<option value="07">07</option>
            	<option value="08">08</option>
            	<option value="09">09</option>
            	<option value="10">10</option>
            	<option value="11">11</option>
            	<option value="12">12</option>
            	<option value="13">13</option>
            	<option value="14">14</option>
            	<option value="15">15</option>
            	<option value="16">16</option>
            	<option value="17">17</option>
            	<option value="18">18</option>
            	<option value="19">19</option>
            	<option value="20">20</option>
            	<option value="21">21</option>
            	<option value="22">22</option>
            	<option value="23">23</option>
            	<option value="24">24</option>
            	<option value="25">25</option>
            	<option value="26">26</option>
            	<option value="27">27</option>
            	<option value="28">28</option>
            	<option value="29">29</option>
            	<option value="30">30</option>
            	<option value="31">31</option>
            	<option value="32">32</option>
            	<option value="33">33</option>
            	<option value="34">34</option>
            	<option value="35">35</option>
            	<option value="36">36</option>
            	<option value="37">37</option>
            	<option value="38">38</option>
            	<option value="39">39</option>
            	<option value="40">40</option>
            	<option value="41">41</option>
            	<option value="42">42</option>
            	<option value="43">43</option>
            	<option value="44">44</option>
            	<option value="45">45</option>
            	<option value="46">46</option>
            	<option value="47">47</option>
            	<option value="48">48</option>
            	<option value="49">49</option>
            	<option value="50">50</option>
            	<option value="51">51</option>
            	<option value="52">52</option>
            	<option value="53">53</option>
            	<option value="54">54</option>
            	<option value="55">55</option>
            	<option value="56">56</option>
            	<option value="57">57</option>
            	<option value="58">58</option>
            	<option value="59">59</option>
            </select><br>
            <label>Event time</label><br><br>
            <input onChange="changetoonline()" type="checkbox" value="yesonline" id="changeonline" name="changeonline">
    <label for="changeonline">&nbsp;Online event</label><br>
    <input type="text" required id="address" name="event_town"><br>
    <label id="eventtwonlabel">Event town</label><br><br>
    <input type="text" required id="event_place" name="event_place"><br>
    <label id="eventplacelabel">Event place<br><br></label>
    <div id="map2" style="width:300px;height:300px"></div>
    <label id="map2label">Mark the party point on the map(required)<br><br></label><br>
    <input id="wheretext" type="text" required name="where_meet"><br>
    <label id="wherelabel">Meet description(when and where)<br><br></label>
    <div id="map" style="width:300px;height:300px"></div>
    <label id="maplabel">Mark the meeting point on the map(required)<br><br></label>
    <input hidden="true" type="text" id="tal_longitude_input" value="-1" name="tal_longitude_input">
    <input hidden="true" type="text" id="tal_lattitude_input" value="-1" name="tal_lattitude_input">
    <input hidden="true" type="text" id="ahol_longitude_input" value="-1" name="ahol_longitude_input">
    <input hidden="true" type="text" id="ahol_lattitude_input" value="-1" name="ahol_lattitude_input">
    
    <p>
    	<input required type="text" id="howmanyperson_textbox" name="howmanyperson_textbox"><br><label>How many person would you invite</label>
    </p>
    <input onChange="hiddenTextbox()" type="checkbox" value="yeah" id="howmanyperson" name="howmanyperson">
    <label for="howmanyperson">&nbsp;Anyone</label>
    <p>
      <button class="buttonshadow" hidden="true" id="bu" type="submit">Create my event</button>
    </p>
<br>

<br>


<script>
function initMap() {
var myCenter = new google.maps.LatLng(40.635010531943855,22.959652841091156);
var myCenter2 = new google.maps.LatLng(40.635010531943855,22.959652841091156);
  var mapCanvas = document.getElementById("map");
  var mapCanvas2 = document.getElementById("map2");
  

  var isMobile = {
			Android: function() {
				return navigator.userAgent.match(/Android/i);
			},
			BlackBerry: function() {
				return navigator.userAgent.match(/BlackBerry/i);
			},
			iOS: function() {
				return navigator.userAgent.match(/iPhone|iPad|iPod/i);
			},
			Opera: function() {
				return navigator.userAgent.match(/Opera Mini/i);
			},
			Windows: function() {
				return navigator.userAgent.match(/IEMobile/i);
			},
			any: function() {
				return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
			}
		};
			if(isMobile.any()) {
				var mapOptions = {center:myCenter, zoom: 7};
				  var mapOptions2 = { center:myCenter2,zoom: 7};
				  var map = new google.maps.Map(mapCanvas, mapOptions);
				  var map2 = new google.maps.Map(mapCanvas2, mapOptions2);
			}else{
				var mapOptions = { zoom: 7};
				  var mapOptions2 = { zoom: 7};
				  var map = new google.maps.Map(mapCanvas, mapOptions);
				  var map2 = new google.maps.Map(mapCanvas2, mapOptions2);
				if (navigator.geolocation) {
			        navigator.geolocation.getCurrentPosition(function(position) {
			          var pos = {
			            lat: position.coords.latitude,
			            lng: position.coords.longitude
			          };
			          map.setCenter(pos);
			          map2.setCenter(pos);
			        }, function() {
			            handleLocationError(true, infoWindow, map.getCenter());
			        });
			      } 
			}
  
  var marker = new google.maps.Marker({position:myCenter});
  //marker.setMap(map);
  var marker2 = new google.maps.Marker({position:myCenter2});
  //marker2.setMap(map2);

  // Zoom to 9 when clicking on marker
  google.maps.event.addListener(marker,'click',function() {
    map.setZoom(17);
    map.setCenter(marker.getPosition());
  });
  
  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(map, event.latLng);
  });
  
  google.maps.event.addListener(marker2,'click',function() {
    map2.setZoom(17);
    map2.setCenter(marker2.getPosition());
  });
  
  google.maps.event.addListener(map2, 'click', function(event) {
    placeMarker2(map2, event.latLng);
  });
  
  function placeMarker(map, location) {
	  document.getElementById("tal_lattitude_input").value = location.lat();
	  document.getElementById("tal_longitude_input").value = location.lng();
	  var marker = new google.maps.Marker({
		position: location,
		map: map
	  });
	  var infowindow = new google.maps.InfoWindow({
		content: 'Here is the meeting point.'
	  });
	  infowindow.open(map,marker);
	}
	
	function placeMarker2(map2, location2) {
	  document.getElementById("ahol_lattitude_input").value = location2.lat();
	  document.getElementById("ahol_longitude_input").value = location2.lng();
	  var marker2 = new google.maps.Marker({
		position: location2,
		map: map2
	  });
	  var infowindow2 = new google.maps.InfoWindow({
		content: 'Here is the party point.'
	  });
	  infowindow2.open(map2,marker2);
	}
}
</script>

<script async defer
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtqi-xZkn_ayp5g0ypNg1T-aAGkDQBwno&callback=initMap"></script>

  </form>
</div>
<?php
impress();
?>
</body>
</html>