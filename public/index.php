<?php

namespace Controllers;

require_once('../app/autoload.php');

session_start();

if (\Session::get('destroyed') && \Session::get('destroyed') < time() - 300) {
	remove_all_authentication_flag_from_active_sessions(\Session::get('user'));
	throw(new DestroyedSessionAccessException);
}

\Session::put('destroyed', time());
session_regenerate_id();
\Session::forget('destroyed');


$controller = 'Page';
if (isset($_GET['controller'])) {
	$controller = $_GET['controller'];
}

$action = 'showHome';
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

$token = null;
if (isset($_GET['token'])) {
	$token = $_GET['token'];
}

if (isset($_POST['token'])) {
	$token = $_POST['token'];
}

if (!isset($_GET['page']) or $_GET['page'] > 1000 or $_GET['page'] < 1) {
	$_GET['page'] = 1;
}

\Factory::process($controller, $action, $token);
