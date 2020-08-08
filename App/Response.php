<?php 

namespace App;

use App\Db\Db;

class Response {
	public static function redirect(string $url = '/') {
		header('Location:' . $url);
		exit;
	}
}