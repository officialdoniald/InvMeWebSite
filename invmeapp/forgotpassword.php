<?php
		if (isset($_GET["emaill"]) && isset($_GET["nev"]) && isset($_GET["pwdd"])) {
			require '../php_files/PHPMailerAutoload.php';

			$pwdd = $_GET["pwdd"];
			$nev = $_GET["nev"];
			$email = $_GET["emaill"];
			$domainemail = 'info@invme.eu';
			$password = '96kEHTPp2o0206';
			
			$mail = new PHPMailer();
			$mail->IsSMTP();                                          // SMTP-n keresztuli kuldes
			$mail->Host     = 'smtp.rackhost.hu';                     // SMTP szerverek
			$mail->SMTPAuth = true;                                   // SMTP
			
			$mail->Username = $domainemail;            // SMTP felhasználo
			$mail->Password = $password;                               // SMTP jelszo
			
			$mail->From     = $domainemail;            // Felado e-mail cime
			$mail->FromName = "Pet info";                // Felado neve
			$mail->AddAddress($email, utf8_decode($nev));         // Cimzett es neve
			//$mail->AddAddress('ellen@site.com');                      // Meg egy cimzett
			$mail->AddReplyTo($domainemail, 'Pet info'); // Valaszlevel ide
			
			$mail->WordWrap = 80;                                     // Sortores allitasa
			//$mail->AddAttachment('/var/tmp/file.tar.gz');             // Csatolas
			//$mail->AddAttachment('/tmp/image.jpg', 'new.jpg');        // Csatolas mas neven
			$mail->IsHTML(true);                                      // Kuldes HTML-kent
			
			$mail->Subject = 'InvMe! Forgot password';                   // A level targya
			$mail->Body    = 'Hi! '.$nev.
			'<br>Your new password is: '.$pwdd
			.'<br> Please change your password in the Settings/Profile Menu!';          // A level tartalma
			//$mail->AltBody = 'This is your alternative password:<b>'.$pass.'</b>'; // A level szoveges tartalma
			
			/*
			
			<label style="font-size:24px;">Hi, '.$fnev.'!</label>
			<label style="font-size:22px;"><p>Welcome to InvMe!</label></p>
			<p>Please click on this conformation link: <a href="www.invme.eu/index.php?tokenconfirm='.$token.'&user='.$fnev.'">www.invme.eu/index.php?tokenconfirm='.$token.'&user='.$fnev.'</a></p><br>
			<p>If you have question, please contact us : info@invme.eu :)</p>
			
			*/
			$mail->Send();
			
			echo 'success';
		}
?>