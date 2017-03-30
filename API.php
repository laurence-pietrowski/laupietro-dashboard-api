<?php

class API {

	private static $get = Array();
	private static $post = Array();
	private static $delete = Array();
	private static $put = Array();

	public static function get($path, $callback) {
		self::$get[$path] = $callback;
	}

	public static function readGet($path) {
		if (array_key_exists($path, self::$get)) {
			return self::$get[$path];
		}
		else {
			return null;
		}
	}

	public static function post($path, $callback) {
		self::$post[$path] = $callback;
	}

	public static function readPost($path) {
		if (array_key_exists($path, self::$post)) {
			return self::$post[$path];
		}
		else {
			return null;
		}
	}

	public static function delete($path, $callback) {
		self::$delete[$path] = $callback;
	}

	public static function readDelete($path) {
		if (array_key_exists($path, self::$delete)) {
			return self::$delete[$path];
		}
		else {
			return null;
		}
	}

	public static function put($path, $callback) {
		self::$put[$path] = $callback;
	}

	public static function readPut($path) {
		if (array_key_exists($path, self::$put)) {
			return self::$put[$path];
		}
		else {
			return null;
		}
	}

}

?>