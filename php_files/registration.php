<?php

require 'labels/labels.php';
$fnev = $_POST["fnev"];
$vnev = $_POST["vnev"];
$knev = $_POST["knev"];
$pw = $_POST["pw"];
$pwagain = $_POST["pwagain"];
$email = $_POST["email"];
$born = $_POST["born"];
$facebook = $_POST["facebook"];
$twitter = $_POST["twitter"];
$profile_picture = addslashes($_FILES['profile_picture']['tmp_name']);
$profile_picture = file_get_contents($profile_picture);
$profile_picture = base64_encode($profile_picture);
$fileSize = $_FILES['profile_picture']['size'];

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

$fnev = strtolower($fnev);
$email = strtolower($email);

// Create connection
$conn = mysql_connect($servername, $username, $password);

if ($_FILES["profile_picture"]["size"] > 67108864) {
    header("Location: ../registration_page.php?file=toolarge");	
}else{
	$qry = "SELECT * FROM users";
	
	mysql_select_db($dbname,$conn);
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($fnev == $row[0])
		{
			header("Location: ../registration_page.php?username=exists");
			exit;
		}
	}
	
	$result = mysql_query($qry,$conn);
	
	while($row = mysql_fetch_array($result))
	{
		if($email == $row[4])
		{
			header("Location: ../registration_page.php?email=exists");
			exit;
		}
	}
	
	$token = confirmToken();
	
	$sql = "INSERT INTO `users` (username, last_name, first_name, password, email, born_date, profile_picture,facebook,twitter,picture_size,confirm) VALUES (N'".$fnev."', N'".$vnev."',N'".$knev."',N'".base64_encode($pw)."',N'".$email."','".$born."','".$profile_picture."',N'".$facebook."',N'".$twitter."','".$fileSize."',N'".$token."')";
	if (mysql_query($sql,$conn)== TRUE) {

		$qry = "INSERT INTO `security_users` (username_really, last_name, first_name, email, born_date, profile_picture,facebook,twitter) VALUES (N'".$fnev."', '1','1','1','1','1','1','1')";
		mysql_query($qry,$conn);
		mysql_close($conn);
		
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
		
		$mail->Subject = 'Inv me! Registration';                   // A level targya
		$mail->Body    = '
		<label style="font-size:24px;">Hi, '.$fnev.'!</label>
		<label style="font-size:22px;"><p>Welcome to InvMe!</label></p>
		<p>Please click on this conformation link: <a href="www.invme.eu/index.php?tokenconfirm='.$token.'&user='.$fnev.'">www.invme.eu/index.php?tokenconfirm='.$token.'&user='.$fnev.'</a></p><br>
		<p>If you have question, please contact us : info@invme.eu :)</p>
		';          // A level tartalma
		//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
		$mail->Send();
		
		header("Location: ../index.php?regsecuessfull=okay");	
	} else {
		header("Location: ../index.php?regsecuessfull=notokay");
	}
}

?>