<?php


namespace App\Router;


use App\Category\CategoryController;
use App\Import\ImportController;
use App\Product\ProductController;
use App\Queue\QueueController;
use App\Renderer;

class Dispatcher
{
    protected $routes = [
        '/products/' => [ProductController::class, 'list'],
        '/products/edit' => [ProductController::class, 'edit'],
        '/products/edit/{id}' => [ProductController::class, 'edit'],
        '/products/add' => [ProductController::class, 'add'],
        '/products/delete' => [ProductController::class, 'delete'],
        '/products/delete_image' => [ProductController::class, 'deleteImage'],

        '/categories/' => [CategoryController::class, 'list'],
        '/categories/add' => [CategoryController::class, 'add'],
        '/categories/edit' => [CategoryController::class, 'edit'],
        '/categories/delete' => [CategoryController::class, 'delete'],
        '/categories/view' => [CategoryController::class, 'view'],

        '/categories/view/{id}' => [CategoryController::class, 'view'],
        '/categories/{id}/view' => [CategoryController::class, 'view'],

        '/queue/list' => [QueueController::class, 'list'],
        '/queue/run' => [QueueController::class, 'run'],

        '/import/index' => [ImportController::class, 'index'],
        '/import/upload' => [ImportController::class, 'upload'],
    ];

    public function dispatch()
    {
        $url = $_SERVER['PATH_INFO'];

        $route = null;

        foreach ($this->routes as $path => $controller) {
            $isSmartPath = strpos($path, '{');
            if ($url == $path) {
                $route = $controller;
                break;
            } else if ($isSmartPath) {
                $isEqual = false;

                $urlChunks = explode('/', $url);
                $pathChunks = explode('/', $path);

                if (count($urlChunks) != count($pathChunks)) {
                    break;
                }

                $controllerParams = [];

                for ($i = 0; $i < count($pathChunks); $i++) {
                    $urlChunk = $urlChunks[$i];
                    $pathChunk = $pathChunks[$i];

                    $isSmartChunk = strpos($pathChunk, '{') !== false && strpos($pathChunk, '}') !== false;

                    if ($urlChunk === $pathChunk) {
                        $isEqual = true;
                    } else if ($isSmartChunk) {
                        $paramName = str_replace(['{', '}'], '', $pathChunk);
                        $controllerParams[$paramName] = $urlChunk;
                        $isEqual = true;
                    } else {
                        $controllerParams = [];
                        $isEqual = false;
                    }
                }

                if (!$isEqual) {
                    continue;
                }

                if ($isEqual === true) {
                    $route = $controller;
                    break;
                }
            }
        }

        $smarty = Renderer::getSmarty();

        if (is_null($route)) {
            $smarty->display('404.tpl');
            exit;
        }

        $class = $route[0];
        $method = $route[1];

        $controller = new $class($controllerParams);
        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            $smarty->display('404.tpl');
            exit;
        }
    }
}