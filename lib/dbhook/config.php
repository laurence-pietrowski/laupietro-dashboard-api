<?php
function registerModules() {
	$baseDir = dirname(__FILE__).DIRECTORY_SEPARATOR;
	$extension = '.php';
	$args = func_get_args();

	foreach($args as $mod) {
		include_once $baseDir.$mod.$extension;
	}
}

registerModules(
	'parser',
	'parser-ini',
	'parser-json',
	'parser-xml',
	'dbmodel'
);

?>