<?php
$event_name = $_POST["event_name"];
$changeonline = $_POST["changeonline"];
$event_time = $_POST["event_time"];
$event_place = $_POST["event_place"];
$event_town = $_POST["event_town"];
$howmanyperson = $_POST["howmanyperson"];
$event_time2 = $_POST["event_time2"];
$to_hour = $_POST["to_hour"];
$to_minute = $_POST["to_minute"];
$nomatter = $_POST["nomatter"];
$howmanyperson_textbox = $_POST["howmanyperson_textbox"];
$where_meet = $_POST["where_meet"];
$description = $_POST["description"];
$tal_longitude_input = $_POST["tal_longitude_input"];
$tal_lattitude_input = $_POST["tal_lattitude_input"];
$ahol_longitude_input = $_POST["ahol_longitude_input"];
$ahol_lattitude_input = $_POST["ahol_lattitude_input"];
$hour = $_POST["hour"];
$minute = $_POST["minute"];
$namikoris = $hour.':'.$minute;
$namikoris2 = $to_hour.':'.$to_minute;
$fromwhentowhen = 'from: '.$event_time.' '.$namikoris.' to: '.$event_time2.' '.$namikoris2;
if($nomatter == "nomatter"){
	$event_time2 = "n";
	$namikoris2 = "n";
	$fromwhentowhen = 'from: '.$event_time.' '.$namikoris.' to: no matter';
}
$cookie_name = "justdontforgettheusername";
$fnev = $_COOKIE[$cookie_name];	
$bement_e = 0;
require 'labels/labels.php';
if($fnev == ""){header("Location: ../index.php");}
if(($ahol_lattitude_input == -1 || $ahol_longitude_input == -1 || $tal_lattitude_input == -1 || $tal_longitude_input == -1) && $changeonline != "yesonline"){
	header("Location: ../create_event.php?map=not");
}
else
{
	$body = "";

	if ($changeonline == "yesonline") {
		$body = '<label style="font-size:24px;">Hi, '.$fnev.'!</label><br><br>
		Event name: <b>'.$event_name.'</b><br><br>
		When: <b>'.$fromwhentowhen.'</b><br><br>
		Where: <b>online</b><br>
		------<br>
		Webpage: <a href="www.invme.eu">www.invme.eu</a>
		<p>If you have question, please contact us : doniald@invme.eu :)</p>
		';
		$event_town = "online";
		$event_place = "";
		$where_meet = "";
		$tal_longitude_input = 0;
		$tal_lattitude_input = 0;
		$ahol_longitude_input = 0;
		$ahol_lattitude_input = 0;
	}else{
		$body = '<label style="font-size:24px;">Hi, '.$fnev.'!</label><br><br>
		Event name: <b>'.$event_name.'</b><br><br>
		When: <b>'.$fromwhentowhen.'</b><br><br>
		Where: <b>'.$event_town.', '.$event_place.'</b><br><br>
		Meeting point: <b>'.$where_meet.'</b><br><br>
		------<br>
		Webpage: <a href="www.invme.eu">www.invme.eu</a>
		<p>If you have question, please contact us : doniald@invme.eu :)</p>
		';
	}

	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	$howmuch = $howmanyperson_textbox;
	
	$sql = "INSERT INTO `events` (event_name, event_time,event_town, event_place, howmanyperson,description,where_meet,tal_longitude_input,tal_lattitude_input,ahol_longitude_input,ahol_lattitude_input,hour, event_time2,hour2,online) VALUES (N'".$event_name."', N'".$event_time."',N'".$event_town."',N'".$event_place."','".$howmuch."',N'".$description."',N'".$where_meet."','".$tal_longitude_input."','".$tal_lattitude_input."','".$ahol_longitude_input."','".$ahol_lattitude_input."','".$namikoris."', N'".$event_time2."','".$namikoris2."', N'".$changeonline."')";
	
	$qry = "SELECT * FROM users";
		$result = mysql_query($qry,$conn);
	$email = "";
		while($row = mysql_fetch_array($result))
		{
			if($row[0] == $fnev){
				$email = $row[4];
				$knev = $row[2];
				$vnev = $row[1];
			}
		}
	
		require 'PHPMailerAutoload.php';

		$domainemail = 'info@invme.eu';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
		$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
		$mail->SMTPAuth = true;                                   // SMTP
		
		$mail->Username = "doniald@invme.eu";            // SMTP felhasználo
		$mail->Password = "96kEHTPp2o0206";                               // SMTP jelszo
		
		$mail->From     = "doniald@invme.eu";            // Felado e-mail cime
		$mail->FromName = "InvMe info";                // Felado neve
		$mail->AddAddress($email, utf8_decode($vnev.' '.$knev));         // Cimzett es neve

		$mail->AddReplyTo("doniald@invme.eu", 'InvMe info'); // Valaszlevel ide

		$mail->WordWrap = 80;                                     // Sortores allitasa
		//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
		//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
		$mail->IsHTML(true);                                      // Kuldes HTML-kent

		$mail->Subject = 'Inv me! Create event';
		$mail->Body    = $body;          // A level tartalma
		//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
		$mail->Send();
	
	if (mysql_query($sql,$conn) == TRUE) {
		$qry = "SELECT * FROM idk";
	    mysql_select_db("idk",$conn);
		$result = mysql_query($qry,$conn);
	
		while($row = mysql_fetch_array($result))
		{
			$bement_e = $row[0] + 1;
		}
		$sql = "INSERT INTO `whos` (who_username, who_event) VALUES (N'".$fnev."', N'".$bement_e."')";
		mysql_query($sql,$conn);
		$sql = "UPDATE idk SET holtart=".$bement_e."";
		mysql_query($sql,$conn);

		$qry = "SELECT * FROM favorite_words order by word asc";

		$result = mysql_query($qry,$conn);

		$qry2 = "SELECT * FROM users";

		$result2 = mysql_query($qry2,$conn);

		$qry3 = "SELECT * FROM security_users";

		$result3 = mysql_query($qry3,$conn);

		while($row = mysql_fetch_array($result))
		{
			if(strpos(strtolower($event_name),strtolower($row[1])) !== false && (strpos(strtolower($event_town),strtolower($row[2])) !== false
					|| $row[2] == "")){

				while($row2 = mysql_fetch_array($result2))
				{
					if($row2[0] == $row[0] && $row[0] != $fnev){

						while($row3 = mysql_fetch_array($result3))
						{
							if($row3[0] == $row2[0] && $row3[8] == 1){
								$domainemail = 'info@invme.eu';
								$mail = new PHPMailer();
								$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
								$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
								$mail->SMTPAuth = true;                                   // SMTP

								$mail->Username = "doniald@invme.eu";            // SMTP felhasználo
								$mail->Password = "96kEHTPp2o0206";                               // SMTP jelszo

								$mail->From     = "doniald@invme.eu";            // Felado e-mail cime
								$mail->FromName = "InvMe info";
								$mail->AddAddress($row2[4],utf8_decode($row2[1].' '.$row2[2]));
								$mail->AddReplyTo("doniald@invme.eu", 'InvMe info');
								$mail->WordWrap = 80;
								$mail->IsHTML(true);
								$mail->Subject = 'Inv me! Create event';
								if ($changeonline == "yesonline") {
									$body = '<label style="font-size:24px;">Hi, '.$row[0].'!</label><br><br>
									Event name: <b>'.$event_name.'</b><br><br>
									When: <b>'.$fromwhentowhen.'</b><br><br>
									Where: <b>online</b><br>
									Link: <a style="font-weight:bold;font-size:20px;" href="www.invme.eu/php_files/event_description.php?eventname='.$event_name.''.'_'.''.$bement_e.'">'.$event_name.'</a>
									<br>------<br>
									Webpage: <a href="www.invme.eu">www.invme.eu</a>
									<p>If you have question, please contact us : doniald@invme.eu :)</p>
									';
											}else{
												$body = '<label style="font-size:24px;">Hi, '.$row[0].'!</label><br><br>
									Event name: <b>'.$event_name.'</b><br><br>
									When: <b>'.$fromwhentowhen.'</b><br><br>
									Where: <b>'.$event_town.', '.$event_place.'</b><br><br>
									Meeting point: <b>'.$where_meet.'</b><br><br>
									Link: <a style="font-weight:bold;font-size:20px;" href="www.invme.eu/php_files/event_description.php?eventname='.$event_name.''.'_'.''.$bement_e.'">'.$event_name.'</a>
									<br>------<br>
									Webpage: <a href="www.invme.eu">www.invme.eu</a>
									<p>If you have question, please contact us : doniald@invme.eu :)</p>
									';
								}
								$mail->Body    = $body;          // A level tartalma
								//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
								$mail->Send();
							}
						}
					}
				}
			}
		}
		mysql_close($conn);
			header("Location: ../main_page.php?eventcreate=okay");
	} else {
		header("Location: ../main_page.php?eventcreate=notokay");
	}
}
?>