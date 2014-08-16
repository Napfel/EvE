<?php

$loadedClasses = 0;
	function __autoload($class_name) {
		$imported = false;
		$namespaces = explode("_", strtolower($class_name));

		if(!$imported) {
			if(file_exists("eve/core/".strtolower($class_name).".php")) {
				require_once "eve/core/".strtolower($class_name).".php";
			}
			else if (file_exists("eve/tools/".strtolower($class_name).".php")) {
				require_once "eve/tools/".strtolower($class_name).".php";
			}
		}
	}