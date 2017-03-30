<?php

$registry = Array();

function loadModules() {
	$baseDir = dirname(__FILE__).DIRECTORY_SEPARATOR;
	$extension = '.php';
	$args = func_get_args();

	foreach($args as $mod) {
		if (strpos($mod, '.') > 0) {
			$mod = str_replace('.', DIRECTORY_SEPARATOR, $mod);
		}
		include_once $baseDir.$mod.$extension;
	}
}

function loadService($service) {
	global $registry;
	loadModules($service);

	$className = substr($service, strrpos($service, '.') + 1);
	$registry[$className] = new $className();
}

function processRequestHeaders($headers) {
	$response = array();

	foreach($headers as $header => $value) {
		if (WhiteList::Headers::validateHeader($header)) {
			$response[$header] = $value;
		}
	}

	return $response;
}

function processQueryString($queryString) {
	$reservedParams = array('realm', 'version', 'request');

	$response = array();
	$queryParams = explode('&', $queryString);
	foreach ($queryParams as $param) {
		if (in_array($param, $reservedParams)) {
			continue;
		}

		$keyValuePair = explode('=', $param);
		$response[$keyValuePair[0]] = $keyValuePair[1];
	}

	return $response;
}

?>