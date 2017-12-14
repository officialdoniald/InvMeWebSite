<?php

$email = $_POST["email"];

$email = strtolower($email);

require 'labels/labels.php';

function confirmToken() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 20; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}

$token = confirmToken();

$conn = mysql_connect($servername, $username, $password);

mysql_select_db($dbname,$conn);

$cookie_name = "justdontforgettheusername";

$fnev = $_COOKIE[$cookie_name];
if($fnev == ""){header("Location: ../index.php");}


if(isset($_COOKIE[$cookie_name])){
$qry = "SELECT * FROM users";

$result = mysql_query($qry,$conn);
$officialemail = "";
while($row = mysql_fetch_array($result))
{
	if($email == $row[4] && $fnev != $row[0]){
		header("Location: update_profile.php?email=exists");
		exit;
	}
	if ($fnev == $row[0])
	{
		$officialemail = $row[4];
	}
}
$sql = "INSERT INTO `emailwaitforconfirm` (username, email, token) VALUES (N'".$fnev."', N'".$email."',N'".$token."')";
if (mysql_query($sql,$conn)== TRUE) {
	require 'PHPMailerAutoload.php';
	
	$domainemail = 'info@invme.eu';
	
	$mail = new PHPMailer();
	$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
	$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
	$mail->SMTPAuth = true;                                   // SMTP
	
	$mail->Username = $domainemail;            // SMTP felhasználo
	$mail->Password = $password;                               // SMTP jelszo
	
	$mail->From     = $domainemail;            // Felado e-mail cime
	$mail->FromName = "InvMe info";                // Felado neve
	$mail->AddAddress($email, utf8_decode($vnev.$knev));         // Cimzett es neve
	//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
	$mail->AddReplyTo($domainemail, 'InvMe info'); // Valaszlevel ide
	
	$mail->WordWrap = 80;                                     // Sortores allitasa
	//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
	//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
	$mail->IsHTML(true);                                      // Kuldes HTML-kent
	
	$mail->Subject = 'Inv me! Confirm new email';                   // A level targya
	$mail->Body    = '
			<link rel="stylesheet" type="text/css" href="../css_style/elemtns_css.css">
		<html><body>
			<label>Hi, <b>'.$fnev.'</b>!</label>
		<p><label>Please click on this conformation link: </label><a style="color:white;" href="www.invme.eu/php_files/logout.php?tokenconfirm='.$token.'&username='.$fnev.'&email='.$email.'">www.invme.eu/php_files/logout.php?tokenconfirm='.$token.'&username='.$fnev.'&email='.$email.'</a></p><br>
		<p><label>If you have question, please contact us : info@invme.eu</label> :)</p></body></html>
		';          // A level tartalma
	//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
	$mail->Send();
	
	$domainemail = 'info@invme.eu';
	
	$mail = new PHPMailer();
	$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
	$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
	$mail->SMTPAuth = true;                                   // SMTP
	
	$mail->Username = $domainemail;            // SMTP felhasználo
	$mail->Password = $password;                               // SMTP jelszo
	
	$mail->From     = $domainemail;            // Felado e-mail cime
	$mail->FromName = "InvMe info";                // Felado neve
	$mail->AddAddress($officialemail, utf8_decode($vnev.$knev));         // Cimzett es neve
	//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
	$mail->AddReplyTo($domainemail, 'InvMe info'); // Valaszlevel ide
	
	$mail->WordWrap = 80;                                     // Sortores allitasa
	//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
	//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
	$mail->IsHTML(true);                                      // Kuldes HTML-kent
	
	$mail->Subject = 'Inv me! Confirm new email';                   // A level targya
	$mail->Body    = '<label style="font-size:24px;">Hi, '.$fnev.'!</label>
		<p>Please click on this conformation link if not you change your email at InvMe!: <a href="www.invme.eu/php_files/notami.php?username='.$fnev.'&email='.$officialemail.'">www.invme.eu/php_files/notami.php?username='.$fnev.'&email='.$officialemail.'</a></p><br>
		<p>If you have question, please contact us : info@invme.eu :)</p>
		';          // A level tartalma
	//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
	$mail->Send();
	
	header("Location: ../profile_edit_page.php?updateemail=successfull");
}
else
{
	header("Location: ../profile_edit_page.php?updateemail=error");
}

}
?>