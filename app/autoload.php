<?php

spl_autoload_register(function ($className) {
	$className = str_replace("\\", "/", $className);
	$className = ucfirst($className);
	if (strpos($className, '/') !== false) {
		$className = lcfirst($className);
	}
	if (file_exists(__DIR__ . "/" . $className . ".php")) {
		require_once(__DIR__ . "/" . $className . ".php");
	} else {
		return false;
	}
});

