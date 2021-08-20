<?php

namespace Service;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class Mail
{
	private $surname;
	private $name;
	private $email;
	private $message;
	private $success = true;
	
	public function __construct($surname, $name, $email, $message)
	{
		$this->surname = $surname;
		$this->name = $name;
		$this->email = $email;
		$this->message = $message;
		$this->send();
	}
	
	/**
	 * Use PHPMailer to send email by SMTP
	 *
	 * @return bool|string
	 * @throws Exception
	 */
	public function send()
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
		
		$mail->Subject = 'Nouveau message de ' . $this->surname . ' ' . $this->name;
		$mail->WordWrap = 50;
		
		$mail->MsgHTML('Prénom :' . $this->surname . '</br>
								Nom :' . $this->name . '</br>
								Mail :' . $this->email . '</br>
								Message :' . $this->message . '</br>');
		if (!$mail->send()) $this->success = $mail->ErrorInfo;
	}
	
	/**
	 * @return bool|string
	 */
	public function isSuccess()
	{
		return $this->success;
	}
}
