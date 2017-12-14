<?php
	$servername = "mysql";
	
	$username = "c1565doniald";
	
	$password = "96kEHTPp2o0206";
	
	$dbname = "c1565invme";
	
	$query_users = "SELECT * FROM users";
	
	$query_event = "SELECT * FROM events";
	
	$query_whos = "SELECT * FROM whos";
	
	function zerotonull($str){
		if ($str == "01") {
			return "1";
		}else if($str == "02"){
			return "2";
		}else if($str == "03"){
			return "3";
		}else if($str == "04"){
			return "4";
		}else if($str == "05"){
			return "5";
		}else if($str == "06"){
			return "6";
		}else if($str == "07"){
			return "7";
		}else if($str == "08"){
			return "8";
		}else if($str == "09"){
			return "9";
		}else{
			return $str;
		}
	}

	function saythemonth($month){
		if ($month == "01") {
			return "Jan";
		}else if($month == "02"){
			return "Febr";
		}else if($month == "03"){
			return "Mar";
		}else if($month == "04"){
			return "Apr";
		}else if($month == "05"){
			return "May";
		}else if($month == "06"){
			return "Jun";
		}else if($month == "07"){
			return "Jul";
		}else if($month == "08"){
			return "Aug";
		}else if($month == "09"){
			return "Sept";
		}else if($month == "10"){
			return "Okt";
		}else if($month == "11"){
			return "Nov";
		}else if($month == "12"){
			return "Dec";
		}
	}

	function menubar(){
		if(strpos($_SERVER['REQUEST_URI'], 'php_files')){
			echo '<table align="center">
  <tr>
  <td><a title="Main page" alt="Main page" href="../main_page.php"><img border="0" width="50" height="50" src="../images/Home.png"></a></td>
    <td><a title="List my friends" alt="List my friends" href="listfriends.php"><img border="0" width="50" height="50" src="../images/Contacts.png"></a></td>
    <td><a title="Joined events" alt="Joined events" href="../list_my_events.php"><img border="0" width="50" height="50" src="../images/Calendar.png"></a></td>
    <td><a title="Hashtags" alt="Hashtags" href="../search.php"><img border="0" width="50" height="50" src="../images/Search.png"></a></td>
  <td><a title="Security settings" alt="Security settings" href="../security_page.php"><img border="0" width="50" height="50" src="../images/Lock.png"></a></td>
  <td><a title="Logout" alt="Logout" href="logout.php"><img border="0" width="50" height="50" src="../images/Cancel.png"></a></td>
  </tr>
</table>';
		}else{
			echo '<table align="center">
  <tr>
  <td><a title="Main page" alt="Main page" href="main_page.php"><img border="0" width="50" height="50" src="images/Home.png"></a></td>
    <td><a title="List my friends" alt="List my friends" href="php_files/listfriends.php"><img border="0" width="50" height="50" src="images/Contacts.png"></a></td>
    <td><a title="Joined events" alt="Joined events" href="list_my_events.php"><img border="0" width="50" height="50" src="images/Calendar.png"></a></td>
    <td><a title="Hashtags" alt="Hashtags" href="search.php"><img border="0" width="50" height="50" src="images/Search.png"></a></td>
  <td><a title="Security settings" alt="Security settings" href="security_page.php"><img border="0" width="50" height="50" src="images/Lock.png"></a></td>
  <td><a title="Logout" alt="Logout" href="php_files/logout.php"><img border="0" width="50" height="50" src="images/Cancel.png"></a></td>
  </tr>
</table> ';
		}
	}
function impress(){
	if(strpos($_SERVER['REQUEST_URI'], 'php_files')){
		echo '<br><br>
<div class="footer"><a style="color:white;" href="../impress.html">Impress</a></div>';
	}else{
		echo '<br><br>
<div class="footer"><a style="color:white;" href="impress.html">Impress</a></div>';
	}
}
function isMobile() {
	$useragent=$_SERVER['HTTP_USER_AGENT'];
	return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4));
}
?>