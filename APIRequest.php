<?php

class APIRequest {

	private $logger = Logger::getLogger('APIRequest');

	private $path;
	private $verb;
	private $callback;

	public function __construct($path, $verb) {
		$this->path = $path;
		$this->verb = $verb;
	}

	public function processRequest() {
		switch($this->verb) {
			case HTTPConstants::GET:
				return $this->processGet();
				break;
			case HTTPConstants::POST:
				return $this->processPost();
				break;
			case HTTPConstants::DELETE:
				return $this->processDelete();
				break;
			case HTTPConstants::PUT:
				return $this->processPut();
				break;
			default:
				return $this->processException(new UnsupportedHttpVerbException($this->verb));
				break;
		}
	}

	private function processGet() {

	}

	private function processPost() {

	}

	private function processDelete() {

	}

	private function processPut() {

	}

	private function processException($exception) {
		
	}

	private function sendResponse($response) {

	}

}

?>