<?php

class UnsupportedHttpVerbException extends Exception {
	
	const MESSAGE = 'Request method {{verb}} is not supported.';

	public function __construct($verb) {
		$message = str_replace('{{verb}}', $verb, self::MESSAGE);
		parent::__construct($message, HTTPConstants::Status::NOT_ALLOWED);
	}

}

?>