<?php

class Db {
	private static $host = '127.0.0.1';
	private static $username = 'root';
	private static $password = '';
	private static $database = 'test';

	private static $connect;

	public static function getConnect() {
		if ( is_null(static::$connect) ) {
			static::$connect = static::connect();
		}

		return static::$connect;
	}

	private static function connect() {
	    $connect = mysqli_connect(static::$host, static::$username, static::$password, static::$database);

	    if (mysqli_connect_errno()) {
	        $error = mysqli_connect_error();
	        var_dump($error);

	        exit;
	    }    

	    return $connect;
	}

	public static function query($query) {
		$conn = static::getConnect();
		$result = mysqli_query($conn, $query);

	    return $result;
	}

	public static function affectedRows() {
		$connect = static::getConnect();

		return mysqli_affected_rows($connect);
	}
}