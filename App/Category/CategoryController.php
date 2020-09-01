<?php


namespace App\Category;


use App\Category;
use App\Product;
use App\Renderer;
use App\Request;
use App\Response;
use App\Router\Route;

class CategoryController
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function add()
    {
        if (Request::isPost()) {
            $category = Category::getFromPost();
            $inserted = Category::add($category);

            if ($inserted) {
                Response::redirect('/categories/list');
            } else {
                die("some insert error");
            }
        }

        $smarty = Renderer::getSmarty();
        $smarty->display('categories/add.tpl');
    }

    public function delete()
    {
        $category_id = Request::getIntFromPost('id', false);

        if (!$category_id) {
            die('Error with id');
        }

        $deleted = Category::deleteById($category_id);

        if ($deleted) {
            Response::redirect('/categories/list');
        } else {
            die("some error with delete");
        }
    }

    public function edit()
    {
        $id = Request::getIntFromGet('id', null);
        if (is_null($id)) {
            $id = $this->params['id'] ?? null;
        }

        $category = [];

        if ($id) {
            $category = Category::getById($id);
        }

        if (Request::isPost()) {
            $category = Category::getFromPost();

            $edited = Category::updateById($id, $category);

            if ($edited) {
                Response::redirect('/categories/list');
            } else {
                die("some insert error");
            }
        }

        $smarty = Renderer::getSmarty();
        $smarty->assign('category', $category);
        $smarty->display('categories/edit.tpl');
    }

    public function list()
    {
        $categories = Category::getList();

        $smarty = Renderer::getSmarty();
        $smarty->assign('categories', $categories);
        $smarty->display('categories/index.tpl');
    }

    public function view()
    {
        $category_id = Request::getIntFromGet('id', null);
        if (is_null($category_id)) {
            $category_id = $this->params['id'] ?? null;
        }

        $category = Category::getById($category_id);
        $products = Product::getListByCategory($category_id);

        $smarty = Renderer::getSmarty();
        $smarty->assign('current_category', $category);
        $smarty->assign('products', $products);
        $smarty->display('categories/view.tpl');
    }
}