<?php
$email = $_POST["email"];
$email = strtolower($email);
require 'labels/labels.php';
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
// Create connection
$conn = mysql_connect($servername, $username, $password);

if (mysql_error($conn) != NULL) {
    header("Location: ../forgot_password.php?errorwiththedatabase=failed");	
}else{
mysql_select_db($dbname,$conn);
$qry = "SELECT * FROM users";
mysql_query("SET NAMES UTF8");
$result = mysql_query($qry,$conn);
while($row = mysql_fetch_array($result)){
	if($email == $row[4]){
		$megegyezett_e = true;
		$fnev = $row[0];
		$vnev = $row[1];
		$knev = $row[2];
	}
}
	if($megegyezett_e == true){
		mysql_close($conn);
		$conn = mysql_connect($servername, $username, $password);
		mysql_select_db($dbname, $conn);
		$pass = randomPassword();
		$qry = "UPDATE users SET password='".$pass."' WHERE email='".$email."'";
		$result = mysql_query($qry,$conn);
		require 'PHPMailerAutoload.php';

		$domainemail = 'info@invme.eu';
		
		$mail = new PHPMailer();
		$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
		$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
		$mail->SMTPAuth = true;                                   // SMTP
		
		$mail->Username = $domainemail;            // SMTP felhasználo
		$mail->Password = "96kEHTPp2o0206";                               // SMTP jelszo
		
		$mail->From     = $domainemail;            // Felado e-mail cime
		$mail->FromName = "InvMe Info";                // Felado neve
		$mail->AddAddress($email, utf8_decode($vnev.$knev));         // Cimzett es neve
		//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
		$mail->AddReplyTo($domainemail, "InvMe Info"); // Valaszlevel ide
		
		$mail->WordWrap = 80;                                     // Sortores allitasa
		//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
		//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
		$mail->IsHTML(true);                                      // Kuldes HTML-kent
		
		$mail->Subject = 'Inv me! Forgot password';                   // A level targya
		$mail->Body    = '<label style="font-size:24px;">Hi, '.$fnev.'!</label>
		<p>This is your alternative password:   <b>'.$pass.'</b></p>
		Webpage: <a href="www.invme.eu">www.invme.eu</a>
		<p>If you have question, please contact us : info@invme.eu :)</p>
		';          // A level tartalma
		//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
		
		if (!$mail->Send()) {
		  header("Location: ../forgot_password.php?errorwiththedatabase=failed");	
		}
		header("Location: ../index.php?emailsuccess=success");
	}else{
		header("Location: ../forgot_password.php?wrongemail=wrong");
	}
}
?>