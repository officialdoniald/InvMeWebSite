<!DOCTYPE html>
<html>
    <head>
        <title>Inv me! registration page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/logo.jpg">
        <link rel="stylesheet" type="text/css" href="css_style/center.css">
        <link rel="stylesheet" type="text/css" href="css_style/elemtns_css.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    	
        <script>
		function changeYear(){
			var year = document.getElementById("year").value;
			var val = document.getElementById("born").value;
			var res = val.split(".");
			document.getElementById("born").value = year + "." + res[1] + "."  + res[2] + "." ;
		}
		function changeMonth(){
			var month = document.getElementById("month").value;
			var val = document.getElementById("born").value;
			var res = val.split(".");
			document.getElementById("born").value = res[0] + "." + month + "."  + res[2] + "." ;
		}
		function changeDay(){
			var day = document.getElementById("day").value;
			var val = document.getElementById("born").value;
			var res = val.split(".");
			document.getElementById("born").value = res[0] + "." + res[1] + "."  + day + "." ;
		}
		function tacc(){
			var r = confirm("Press a button");
			if (r == true) {
				document.getElementById("tac").checked = true;
			} else {
				document.getElementById("tac").checked = false;
			} 
		}
		function changePw(){
			var pwvalue = document.getElementById("pw").value;
			var pwagainvalue = document.getElementById("pwagain").value;
			var pwlength = pwvalue.length;
			var pwagainlength = pwagainvalue.length;
			if((pwlength < 6 || pwlength > 16) || (pwagainlength < 6 && pwagainlength > 16)){
				document.getElementById("notgoodlength").hidden = false;
			}else{
				document.getElementById("notgoodlength").hidden = true;
			}
			if(pwvalue != pwagainvalue){
				document.getElementById("notthesamepw").hidden = false;
			}else{
				document.getElementById("notthesamepw").hidden = true;
			}
		}
		</script>
    </head>
    <body>
    <?php
if (isset($_GET["passwordexception"]) && $_GET["passwordexception"] == 'notequals') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> The passwords does\'nt match!
  </div></p>';
}
if (isset($_GET["file"]) && $_GET["file"] == 'toolarge') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> The picture is too large!
  </div></p>';
}
if (isset($_GET["passwordexception"]) && $_GET["passwordexception"] == 'toolargeorno') {
	echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Passwords must be 6-16 charachter length!
  </div></p>';
}
if (isset($_GET["username"]) && $_GET["username"] == 'exists') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> Username alredy exists!
  </div></p>';
}
if (isset($_GET["email"]) && $_GET["email"] == 'exists') {
echo '<p><div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Oops!</strong> E-mail alredy exists!
  </div></p>';
}
?>
        <div align="center">
        <h1 style="color:white;font-size:50px;font-family:Segoe;">Sign in</h1>
        	<form  action="php_files/registration.php" method="post" enctype="multipart/form-data">
            <input required type="text" name="fnev"><br><label>Username(*)</label><br><br>
            <input required type="text" name="vnev"><br><label>First Name(*)</label><br><br>
            <input required type="text" name="knev"><br><label>Last Name(*)</label><br><label hidden="true" id="notthesamepw" style="color:red;">Not the same passwords.</label>
            <label hidden="true" id="notgoodlength" style="color:red;">Passwords must be 6-16 charachter length.</label><br>
            <input required type="password" onkeyup="changePw()" id="pw" name="pw"><br><label>Password(*)</label><br><br>
            <input required type="password" onkeyup="changePw()" id="pwagain" name="pwagain"><br><label>Confirm password(*)</label><br><br>
            <input required type="text" name="email"><br><label>E-mail(*)</label><br><br>
             <select class="select" onChange="changeYear()" required id="year">
              	<option value="1900">1900</option>
                <option value="1901">1901</option>
                <option value="1902">1902</option>
                <option value="1903">1903</option>
                <option value="1904">1904</option>
                <option value="1905">1905</option>
                <option value="1906">1906</option>
                <option value="1907">1907</option>
                <option value="1908">1908</option>
                <option value="1909">1909</option>
                <option value="1910">1910</option>
                <option value="1911">1911</option>
                <option value="1912">1912</option>
                <option value="1913">1913</option>
                <option value="1914">1914</option>
                <option value="1915">1915</option>
                <option value="1916">1916</option>
                <option value="1917">1917</option>
                <option value="1918">1918</option>
                <option value="1919">1919</option>
                <option value="1920">1920</option>
                <option value="1921">1921</option>
                <option value="1922">1922</option>
                <option value="1923">1923</option>
                <option value="1924">1924</option>
                <option value="1925">1925</option>
                <option value="1926">1926</option>
                <option value="1927">1927</option>
                <option value="1928">1928</option>
                <option value="1929">1929</option>
                <option value="1930">1930</option>
                <option value="1931">1931</option>
                <option value="1932">1932</option>
                <option value="1933">1933</option>
                <option value="1934">1934</option>
                <option value="1935">1935</option>
                <option value="1936">1936</option>
                <option value="1937">1937</option>
                <option value="1938">1938</option>
                <option value="1939">1939</option>
                <option value="1940">1940</option>
                <option value="1941">1941</option>
                <option value="1942">1942</option>
                <option value="1943">1943</option>
                <option value="1944">1944</option>
                <option value="1945">1945</option>
                <option value="1946">1946</option>
                <option value="1947">1947</option>
                <option value="1948">1948</option>
                <option value="1949">1949</option>
                <option value="1950">1950</option>
                <option value="1951">1951</option>
                <option value="1952">1952</option>
                <option value="1953">1953</option>
                <option value="1954">1954</option>
                <option value="1955">1955</option>
                <option value="1956">1956</option>
                <option value="1957">1957</option>
                <option value="1958">1958</option>
                <option value="1959">1959</option>
                <option value="1960">1960</option>
                <option value="1961">1961</option>
                <option value="1962">1962</option>
                <option value="1963">1963</option>
                <option value="1964">1964</option>
                <option value="1965">1965</option>
                <option value="1966">1966</option>
                <option value="1967">1967</option>
                <option value="1968">1968</option>
                <option value="1969">1969</option>
                <option value="1970">1970</option>
                <option value="1971">1971</option>
                <option value="1972">1972</option>
                <option value="1973">1973</option>
                <option value="1974">1974</option>
                <option value="1975">1975</option>
                <option value="1976">1976</option>
                <option value="1977">1977</option>
                <option value="1978">1978</option>
                <option value="1979">1979</option>
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
            </select> 
            <select class="select" onChange="changeMonth()" required id="month">
            	<option value="01">January</option>
            	<option value="02">February</option>
            	<option value="03">March</option>
            	<option value="04">April</option>
            	<option value="05">May</option>
            	<option value="06">June</option>
            	<option value="07">July</option>
            	<option value="08">August</option>
            	<option value="09">Septembert</option>
            	<option value="10">Oktober</option>
            	<option value="11">November</option>
            	<option value="12">December</option>
            </select>
            <select class="select" onChange="changeDay()" required id="day">
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
            <input required hidden="true" type="text" id="born" value="1900.01.01." name="born"><br><br>
            <label>Date of born(*)</label><br><br>
            <input type="text" name="facebook"><br><img border="0" width="50" height="50" src="images/Facebook.png"><br><br>
            <input type="text" name="twitter"><br><img border="0" width="50" height="50" src="images/Twitter.png"><br><br>
            <label>Profile picture</label><br><br>
            <p><input type="file" name="profile_picture" accept="image/*;capture=camera"></p>
            <input type="checkbox" id="tac" name="tac" required>&nbsp;<label for="tac">I accepted the </label><label>&nbsp;<a style="color:white;" onClick="tacc()"> terms and conditions!</a></label><br>
            <button type="submit" class="buttonshadow">Sign In</button><br><br>
            </form>
        </div>
<br><br><br><br>
<div class="footer"> Copyright © Inv me! <a style="color:white;" href="impress.html">Impress</a></div>
    </body>
</html>