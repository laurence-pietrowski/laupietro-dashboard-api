<?php

abstract class Parser {

	protected $host; // String
	protected $username; // String
	protected $password; // String
	protected $database; // String
	protected $autocommit; // Boolean
	
	public function getHost() {
		return $this->host;
	}

	public function getUsername() {
		return $this->username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getDatabase() {
		return $this->database;
	}

	public function isAutocommit() {
		return $this->autocommit;
	}

	/**
	 * setAutocommit - Sets the value for autocommit (whether the database will automatically save the save or if it will
	 * require an extra command to do so). Will return <i>true</i> by default (assumes DB cannot support transactions)
	 * @author Laurence Pietrowski
	 * @param $value - the autocommit value coming from the configuration file
	 * @return true if it needs to auto-commit, false if a manual transaction is needed
	 */
	protected function setAutocommit($value) {
		if (isset($value)) {
			switch (gettype($value)) {
				case 'string':
					$lowerValue = strtolower($value);
					return $lowerValue == 'true';
				case 'boolean': 
					return $value;
				case 'integer':
					return $value == 1;
				default:
					// Unknow type provided, assume configuration error and return true;
					return true;
			}
		}
		else {
			// No value provided, return true
			return true;
		}
	}

}

?>