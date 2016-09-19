<?php

function registerModules() {
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

registerModules(
	'lib.logger.Logger',
	'lib.dbhook.dbhook'
);

Logger::configure('logger-config.xml');

?>