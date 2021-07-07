<?php

namespace Controllers;

class Account extends Controller
{
	public function register()
	{
		$exists = $this->account->exists($_POST['pseudo'], $_POST['mail']);
		if ($exists === false) {
			$this->account->create($_POST['pseudo'], $_POST['password'], $_POST['mail']);
		}
		else {
			return $exists;
		}
	}
	
	public function UserConnected()
	{
		return $this->account->connect($_POST['password'], $_POST['username']);
	}
}