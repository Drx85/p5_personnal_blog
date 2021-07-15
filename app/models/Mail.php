<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;


class Mail extends Model
{
	public function send($surname, $name, $email, $message)
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = \Config::MAIL_HOST;
		$mail->Port = \Config::MAIL_PORT;
		$mail->SMTPAuth = 1;
		
		if($mail->SMTPAuth){
			$mail->SMTPSecure = 'ssl';
			$mail->Username   =  \Config::MAIL_USERNAME;
			$mail->Password   =  \Config::MAIL_PASSWORD;
		}
		
		$mail->addAddress(\Config::MAIL_USERNAME);
		$mail->CharSet = 'UTF-8';
		$mail->smtpConnect();
		$mail->From       =  \Config::MAIL_USERNAME;
		
		$mail->Subject    =  'Nouveau message de ' . $surname . ' ' . $name;
		$mail->WordWrap   = 50;

		$mail->MsgHTML('Prénom :' . $surname . '</br>
								Nom :' . $name . '</br>
								Mail :' .$email . '</br>
								Message :' . $message . '</br>');
		$mail->send();
	}
}
