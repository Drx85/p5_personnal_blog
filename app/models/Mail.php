<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;


class Mail extends Model
{
	public function send($surname, $name, $email, $message)
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = 'mail.infomaniak.com';
		$mail->Port = 465;
		$mail->SMTPAuth = 1;
		
		if($mail->SMTPAuth){
			$mail->SMTPSecure = 'ssl';
			$mail->Username   =  'cedric@deperne.fr';
			$mail->Password   =  '4iu6uJdAJkZxW3i';
		}
		
		$mail->addAddress('cedric@deperne.fr');
		$mail->CharSet = 'UTF-8';
		$mail->smtpConnect();
		$mail->From       =  'cedric@deperne.fr';
		
		$mail->Subject    =  'Nouveau message de ' . $surname . ' ' . $name;
		$mail->WordWrap   = 50;

		$mail->MsgHTML('Prénom :' . $surname . '</br>
								Nom :' . $name . '</br>
								Mail :' .$email . '</br>
								Message :' . $message . '</br>');
		$mail->send();
	}
}
