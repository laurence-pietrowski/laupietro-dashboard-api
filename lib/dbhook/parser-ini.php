<?php

class ParserIni extends Parser {

	public function __construct($filename) {
		$fileProps = parse_ini_file($filename);
		if (!$fileProps) {
			throw new Exception('Unable to parse ini file '.$filename);
		}
		$this->host = $fileProps['host'];
		$this->username = $fileProps['username'];
		$this->password = $fileProps['password'];
		$this->database = $fileProps['database'];
		$this->autocommit = $this->setAutocommit($fileProps['autocommit']);
	}

}

?>