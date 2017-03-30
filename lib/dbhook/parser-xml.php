<?php

class ParserXml extends Parser {

	public function __construct($filename) {
		$fileProps = simplexml_load_file($filename);
		if (!$fileProps) {
			throw new Exception('Unable to parse xml file '.$filename);
		}
		$this->host = $fileProps->host;
		$this->username = $fileProps->username;
		$this->password = $fileProps->password;
		$this->database = $fileProps->database;
		$this->autocommit = $this->setAutocommit($fileProps->autocommit);
	}

}

?>