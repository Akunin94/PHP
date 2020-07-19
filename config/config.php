<?php

require_once __DIR__ . '/../libs/Smarty/Smarty.class.php';
require_once __DIR__ . '/../App/Product.php';
require_once __DIR__ . '/../App/Category.php';

function connect($host, $user, $password, $database) {
    $connect = mysqli_connect($host, $user, $password, $database);

    if (mysqli_connect_errno()) {
        $error = mysqli_connect_error();
        var_dump($error);

        exit;
    }    

    return $connect;
}

function query($connect, $query) {
   $result = mysqli_query($connect, $query);

    if (mysqli_errno($connect)) {
        var_dump(mysqli_error($connect));

        exit;
    } 

    return $result;
}

$connect = connect('127.0.0.1', 'root', '', 'test');

$smarty = new Smarty();
$smarty -> template_dir = __DIR__ . '/../templates';
$smarty -> compile_dir = __DIR__ . '/../var/compile';
$smarty -> cache_dir = __DIR__ . '/../var/cache';
$smarty -> config_dir = __DIR__ . '/../var/config';