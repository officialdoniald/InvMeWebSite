<?php
	$friend = $_POST["friend"];

	$list = $_POST["lis"];

	$cookie_name = "justdontforgettheusername";
	
	$fnev = $_COOKIE[$cookie_name];
	if($fnev == ""){header("Location: ../index.php");}
	$eventname = $_COOKIE["lastselectedevent"];

	require 'labels/labels.php';
	
	$conn = mysql_connect($servername, $username, $password);
$qry = "SELECT * FROM users";
		mysql_select_db($dbname,$conn);
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
		mysql_select_db($dbname,$conn);
		$result = mysql_query($qry,$conn);
		$reallyeventname = "";
		while($row = mysql_fetch_array($result))
		{
			if($row[0] == $eventname){
				$reallyeventname = $row[1];
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
		//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
		$mail->AddReplyTo("doniald@invme.eu", 'InvMe info'); // Valaszlevel ide
		
		$mail->WordWrap = 80;                                     // Sortores allitasa
		//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
		//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
		$mail->IsHTML(true);                                      // Kuldes HTML-kent
		
		$mail->Subject = 'Inv me! Unsubscribe from an event';                   // A level targya
		$mail->Body    = '<label style="font-size:24px;">Hi, '.$fnev.'!</label><br>
		Event name: <b>'.$reallyeventname.'</b><br>
		------<br>
		Webpage: <a href="www.invme.eu">www.invme.eu</a>
		<p>If you have question, please contact us : doniald@invme.eu :)</p>
		';          // A level tartalma
		//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
		$mail->Send();
		
		mysql_select_db($dbname,$conn);
	$qry = "DELETE FROM whos WHERE who_username=N'".$fnev."' AND who_event=N'".$eventname."'";
			
			$result = mysql_query($qry,$conn);
			
			if($result == 1)
			{
				if($list == "aha"){
					header("Location: ../list_my_events.php?un=yes");
				}else{
				header("Location: ../list_events.php?un=yes");
				}
			}
			else
			{
				if($list == "aha"){
					header("Location: ../list_my_events.php?un=yes");
				}else{
			 	header("Location: ../list_events.php?un=no");
				}
			}
?>