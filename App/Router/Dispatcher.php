<?php


namespace App\Router;


use App\Product\ProductController;

class Dispatcher
{
    protected $routes = [
        '/products/' => [ProductController::class, 'list'],
        '/products/edit' => [ProductController::class, 'edit'],
        '/products/add' => [ProductController::class, 'add'],
    ];

    public function dispatch()
    {
        $url = $_SERVER['PATH_INFO'];

        $route = null;

        foreach ($this->routes as $path => $controller) {
            if ($url == $path) {
                $route = $controller;
                break;
            }
        }

        $smarty = \App\Renderer::getSmarty();

        if (is_null($route)) {
            $smarty->display('404.tpl');
            exit;
        }

        $class = $route[0];
        $method = $route[1];

        $controller = new $class();
        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            $smarty->display('404.tpl');
            exit;
        }
    }
}