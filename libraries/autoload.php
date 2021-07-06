<?php

spl_autoload_register(function ($className) {
	$className = str_replace("\\", "/", $className);
	$className = lcfirst($className);
	require_once ("libraries/$className.php");
});