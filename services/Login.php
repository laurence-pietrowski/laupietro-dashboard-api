<?php

/**
* Login service
*/

class Login {

	public function __construct() {
		API::get('/core/v1/login.test', function () {
			return self::loginTest();
		});
	}

	public static function loginTest() {
		return "Testing worked!";
	}

}

?>