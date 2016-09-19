<?php

class ParserJson extends Parser {
	
	public function __construct($filename) {
		$jsonString = file_get_contents($filename);
		if (!$jsonString) {
			throw new Exception('Unable to get contents for file '.$filename);
		}
		$fileProps = json_decode($jsonString);
		if (!$fileProps) {
			throw new Exception('Unable to parse json for file '.$filename);
		}
		$this->host = $fileProps->host;
		$this->username = $fileProps->username;
		$this->password = $fileProps->password;
		$this->database = $fileProps->database;
		$this->autocommit = $this->setAutocommit($fileProps->autocommit);
	}

}

?>