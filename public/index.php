<?php

namespace Controllers;

require_once'../app/autoload.php';

session_start();

$controller = \Factory::affectGlobal('controller', 'GET', 'Page');
$action = \Factory::affectGlobal('action', 'GET', 'showHome');
$token = \Factory::affectGlobal('token', 'GET', null);

if (!$token) {
	$token = \Factory::affectGlobal('token', 'POST', null);
}

try {
	\Factory::process($controller, $action, $token);
} catch (\Error $e) {
	echo $e->getMessage(); die;
	$controller = new BaseController();
	$controller->show404();
}
