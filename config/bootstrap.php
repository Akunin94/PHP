<?php

use App\Category;
use App\Renderer;
use App\Router\Dispatcher;

require_once __DIR__ . '/config.php';

//$url = $_SERVER['PATH_INFO'];


$categories = Category::getList();

Renderer::getSmarty()->assign('categories_shared', $categories);

$dispatcher = new Dispatcher();
$dispatcher->dispatch();

//$routers = [
//    '/products/' => [\App\Controller\ProductController::class, 'list'],
//    '/products/edit' => [\App\Controller\ProductController::class, 'edit'],
//    '/products/add' => [\App\Controller\ProductController::class, 'add'],
//];

//$route = null;
//
//foreach ($routers as $path => $controller) {
//    if ($url == $path) {
//        $route = $controller;
//        break;
//    }
//}
//
//if (is_null($route)) {
//    $smarty->display('404.tpl');
//    exit;
//}
//
//$class = $route[0];
//$method = $route[1];
//
//$controller = new $class();
//if (method_exists($controller, $method)) {
//    $controller->{$method}();
//} else {
//    $smarty->display('404.tpl');
//    exit;
//}

//$controller = new \App\Controller\ProductController();
//$controller->list();
//$is_index = substr($url, -1) == '/';
//if ($is_index) {
//    $url .= 'list';
//}
//
//$controller_path = $_SERVER['DOCUMENT_ROOT'] . '/../App/Controllers' . $url . '.php';

//if (file_exists($controller_path)) {
//    try {
//        require_once $controller_path;
//    } catch (\Throwable $e) {
//        dump('no $controller_path', true);
//    }
//
//} else {
//    $smarty->display('404.tpl');
//}