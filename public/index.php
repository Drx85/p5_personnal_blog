<?php

namespace Controllers;

require_once('../app/autoload.php');

session_start();

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
