<?php

namespace Controllers;

require_once'../app/autoload.php';

session_start();

/*if (\Session::get('destroyed') && \Session::get('destroyed') < time() - 300) {
	remove_all_authentication_flag_from_active_sessions(\Session::get('user'));
	throw(new DestroyedSessionAccessException);
}

\Session::put('destroyed', time());
session_regenerate_id();
\Session::forget('destroyed');*/

$controller = \Factory::affectGlobal('controller', 'GET', 'Page');
$action = \Factory::affectGlobal('action', 'GET', 'showHome');
$token = \Factory::affectGlobal('token', 'GET', null);

if (!$token) {
	$token = \Factory::affectGlobal('token', 'POST', null);
}

try {
	\Factory::process($controller, $action, $token);
} catch (\Error $e) {
	$controller = new Page();
	$controller->show404();
}
