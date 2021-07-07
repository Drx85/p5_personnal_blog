<?php

spl_autoload_register(function ($className) {
	$className = str_replace("\\", "/", $className);
	$className = lcfirst($className);
	require_once(__DIR__ . "/" . $className . ".php");
});