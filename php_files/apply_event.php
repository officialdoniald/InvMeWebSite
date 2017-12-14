<?php
$eventname = $_POST["eventnamed"];

require 'labels/labels.php';

$cookie_name = "justdontforgettheusername";

if(isset($_COOKIE[$cookie_name]))
{
	$fnev = $_COOKIE[$cookie_name];	
	if($fnev == ""){header("Location: ../index.php");}
	$conn = mysql_connect($servername, $username, $password);
	
	mysql_select_db($dbname,$conn);
	
	mysql_query("SET NAMES UTF8");	
	
	$qry = "SELECT * FROM whos";
	
	mysql_select_db($dbname,$conn);
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($fnev == $row[0] && $eventname == $row[1])
		{
			header("Location: ../list_events.php?apply_event=exists");
			exit;
		}
	}
	
	$qry = "SELECT * FROM users";
	    mysql_select_db("users",$conn);
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
	
	
	$qry = "SELECT * FROM events";
	
	mysql_select_db("events",$conn);
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($eventname == $row[0])
		{
			$body = "";
			$fromwhen = "";

			if($row[12] == "n"){
				$fromwhen = 'from '.$row[2].' '.$row["hour"].' to no matter';
			}else{
				$fromwhen = 'from '.$row[2].' '.$row["hour"].' to '.$row["event_time2"].' '.$row["hour2"];
			}

			if ($row["online"] == "yesonline") {
				$body = '<label style="font-size:24px;">Hi, '.$fnev.'!</label><br>
				Event name: <b>'.$row[1].'</b><br>
				When: <b>'.$fromwhen.'</b><br>
				Where: <b>online</b><br>
				------<br>
				Webpage: <a href="www.invme.eu">www.invme.eu</a>
				<p>If you have question, please contact us : doniald@invme.eu :)</p>
				';
			}else{
				$body = '<label style="font-size:24px;">Hi, '.$fnev.'!</label><br>
				Event name: <b>'.$row[1].'</b><br>
				Where: <b>'.$row[3].', '.$row[4].'</b><br>
				When: <b>'.$fromwhen.'</b><br>
				Meeting point: <b>'.$row[7].'</b><br>
				------<br>
				Webpage: <a href="www.invme.eu">www.invme.eu</a>
				<p>If you have question, please contact us : doniald@invme.eu :)</p>
				';
			}

		require 'PHPMailerAutoload.php';

		$domainemail = 'doniald@invme.eu';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
		$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
		$mail->SMTPAuth = true;                                   // SMTP
		
		$mail->Username = "doniald@invme.eu";            // SMTP felhasználo
		$mail->Password = "96kEHTPp2o0206";                               // SMTP jelszo
		
		$mail->From     = "doniald@invme.eu";            // Felado e-mail cime
		$mail->FromName = "InvMe info";                // Felado neve
		$mail->AddAddress($email, utf8_decode($vnev.' '.$knev));         // Cimzett es nev

		//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
		$mail->AddReplyTo("doniald@invme.eu", 'InvMe info'); // Valaszlevel ide
		
		$mail->WordWrap = 80;                                     // Sortores allitasa
		//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
		//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
		$mail->IsHTML(true);                                      // Kuldes HTML-kent
		
		$mail->Subject = 'Inv me! Apply event';                   // A level targya
		$mail->Body    = $body;          // A level tartalma
		//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
		$mail->Send();
		break;
		}
	}
	
	$sql = "INSERT INTO `whos` (who_username, who_event) VALUES (N'".$fnev."', N'".$eventname."')";

	if (mysql_query($sql,$conn)== TRUE) {
		mysql_close($conn);
		header("Location: ../list_events.php?apply_event=okay");	
	} else {
		header("Location: ../list_events.php?apply_event=notokay");
	}
}
else{
header("Location: ../index.php");	
}
?>