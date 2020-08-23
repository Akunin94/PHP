<?php

require_once __DIR__ . '/../vendor/autoload.php';

define('APP_DIR', realpath(__DIR__ . '/../') );
define('APP_PUBLIC_DIR', APP_DIR . '/public');
define('APP_UPLOAD_DIR', APP_PUBLIC_DIR . '/upload');
define('APP_UPLOAD_PRODUCT_DIR', APP_UPLOAD_DIR . '/products');

if ( !file_exists(APP_UPLOAD_DIR) ) {
	mkdir(APP_UPLOAD_DIR);
}
if ( !file_exists(APP_UPLOAD_PRODUCT_DIR) ) {
	mkdir(APP_UPLOAD_PRODUCT_DIR);
}

function deleteDir($dir) {
	$files = array_diff(scandir($dir), ['.','..']);
	foreach ($files as $file) {
		(is_dir("$dir/$file")) ? deleteDir("$dir/$file") : unlink("$dir/$file");
	}

	return rmdir($dir);
}

function dump( $expression, $ex = false ) {
	echo "<pre>";
	var_dump($expression);
	echo "</pre>";
	if ( $ex ) {
		exit;
	}
}