<?php

require_once 'config.php';

// App Initializer
loadModules(
	'API',
	'APIRequest',
	'Response',
	'constants.HTTPConstants',
	'lib.dbhook.dbhook',
	'lib.logger.Logger'
);

loadService('services.Login');

Logger::configure('logger-config.xml');

$_logger = Logger::getLogger('main');

$realm = $_REQUEST['realm'];
$version = $_REQUEST['version'];
$request = $_REQUEST['request'];

$path = '/' . $realm . '/v' . $version . '/' . $request;
$verb = $_SERVER['REQUEST_METHOD'];

$_logger->trace($verb . ': ' . $path);

switch($verb) {
	case HTTPConstants::GET:
		$callback = API::readGet($path);
		$query = processQueryString($_SERVER['QUERY_STRING']);
		break;
	case HTTPConstants::POST:
		$callback = API::readPost($path);
		break;
	case HTTPConstants::DELETE:
		$callback = API::readDelete($path);
		break;
	case HTTPConstants::PUT:
		$callback = API::readPut($path);
		break;
	default:
		$callback = null;
		break;
}

$headers = processRequestHeaders(getallheaders());

if ($callback === null) {
	echo "404";
}
else {
	echo $callback();
}

?>