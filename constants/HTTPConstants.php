<?php

class HTTPConstants {
	
	const GET = 'GET';
	const POST = 'POST';
	const DELETE = 'DELETE';
	const PUT = 'PUT';

	class Status {

		const OK = 200;
		const CREATED = 201;
		const ACCEPTED = 202;
		const NO_CONTENT = 204;

		const BAD_REQUEST = 400;
		const UNAUTHORIZED = 401;
		const FORBIDDEN = 403;
		const NOT_FOUND = 404;
		const NOT_ALLOWED = 405;
		const CONFLICT = 409;
		const GONE = 410;
		const PAYLOAD_TOO_LARGE = 413;
		
		const INTERNAL_SERVER_ERROR = 500;
		const NOT_IMPLEMENTED = 501;
		const SERVICE_NOT_AVAILABLE = 503;

	}

}

?>