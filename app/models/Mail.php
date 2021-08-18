<?php

namespace Models;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class Mail extends Model
{
	/**
	 * Use PHPMailer to send email by SMTP
	 *
	 * @param \Entities\Mail $userMail
	 *
	 * @throws Exception
	 */
	public function send(\Entities\Mail $userMail)
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = \Config::MAIL_HOST;
		$mail->Port = \Config::MAIL_PORT;
		$mail->SMTPAuth = 1;
		
		if ($mail->SMTPAuth) {
			$mail->SMTPSecure = 'ssl';
			$mail->Username = \Config::MAIL_USERNAME;
			$mail->Password = \Config::MAIL_PASSWORD;
		}
		
		$mail->addAddress(\Config::MAIL_USERNAME);
		$mail->CharSet = 'UTF-8';
		$mail->smtpConnect();
		$mail->From = \Config::MAIL_USERNAME;
		
		$mail->Subject = 'Nouveau message de ' . $userMail->getSurname() . ' ' . $userMail->getName();
		$mail->WordWrap = 50;
		
		$mail->MsgHTML('Prénom :' . $userMail->getSurname() . '</br>
								Nom :' . $userMail->getName() . '</br>
								Mail :' . $userMail->getEmail() . '</br>
								Message :' . $userMail->getMessage() . '</br>');
		if (!$mail->send()) return $mail->ErrorInfo;
		return true;
	}
}
