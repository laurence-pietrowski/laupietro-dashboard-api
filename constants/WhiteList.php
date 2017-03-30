<?php

class WhiteList {
	
	class Headers {

		const ACCESS_TOKEN = 'access-token';
		const ACCEPT = 'accept';
		const ACCEPT_LANGUAGE = 'accept-language';
		const CONTENT = 'content';
		const CONTENT_TYPE = 'content-type';

		public static function validateHeader($header) {
			switch(strtolower($header)) {
				case self::ACCESS_TOKEN:
				case self::ACCEPT:
				case self::ACCEPT_LANGUAGE:
				case self::CONTENT:
				case self::CONTENT_TYPE:
					return true;
					break;
				default:
					return false;
					break;
			}
		}

	}

}

?>