<?php

namespace Controllers;

require_once('../app/autoload.php');

session_start();

if (isset($_SESSION['destroyed'])
	&& $_SESSION['destroyed'] < time() - 300) {
	remove_all_authentication_flag_from_active_sessions($_SESSION['user']);
	throw(new DestroyedSessionAccessException);
}

$_SESSION['destroyed'] = time();
session_regenerate_id();
unset($_SESSION['destroyed']);


$controller = 'Page';
if (isset($_GET['controller'])) {
	$controller = $_GET['controller'];
}

$action = 'showHome';
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

if (!isset($_GET['page']) or $_GET['page'] > 1000 or $_GET['page'] < 1) {
	$_GET['page'] = 1;
}

\Factory::process($controller, $action);
