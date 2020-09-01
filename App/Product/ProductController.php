<?php


namespace App\Product;


use App\Category;
use App\Product;
use App\ProductImage;
use App\Renderer;
use App\Request;
use App\Response;
use App\Router\Route;

class ProductController
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function list()
    {
        $current_page = Request::getIntFromGet('p', 1);

        $limit = 4;
        $offset = (int)(($current_page - 1) * $limit);

        $products_count = Product::getListCount();
        $page_count = ceil($products_count / $limit);

        $productRepository = new ProductRepository();
        $products = $productRepository->getList($limit, $offset);
//$products = Product::getList($limit, $offset);

        $smarty = Renderer::getSmarty();

        $smarty->assign('pages_count', $page_count);
        $smarty->assign('products', $products);
        $smarty->display('products/index.tpl');
    }

    public function edit()
    {
        $productId = Request::getIntFromGet('id', null);
        if (is_null($productId)) {
            $productId = $this->route->getParam('id');
        }

        $product = [];

        $productRepository = new Product\ProductRepository();

        if ($productId) {
            $product = $productRepository->getById($productId);
        }

        if (Request::isPost()) {
            $productData = Product::getDataFromPost();

            $product->setName($productData['name']);
            $product->setArticle($productData['article']);
            $product->setDescription($productData['description']);
            $product->setAmount($productData['amount']);
            $product->setPrice($productData['price']);

            $categoryId = $productData['category_id'] ?? 0;
            if ($categoryId) {
                $categoryData = \App\Category::getById($categoryId);
                $categoryName = $categoryData['name'];
                $category = new Category\CategoryModel($categoryName);
                $category->setId($categoryId);

                $product->setCategory($category);
            }

            $product = $productRepository->save($product);

            /* START ЗАГРУЗКА ПО URL */
            $imageUrl = trim($_POST['image_url']);
            ProductImage::uploadImageByUrl($productId, $imageUrl);
            /* END ЗАГРУЗКА ПО URL */

            /* START ЗАГРУЗКА С ДИСКА*/
            $uploadImages = $_FILES['images'] ?? [];
            ProductImage::uploadImages($productId, $uploadImages);
            /* END ЗАГРУЗКА С ДИСКА*/

            Response::redirect('/products/list');
        }

        $categories = Category::getList();

        $smarty = \App\Renderer::getSmarty();

        $smarty->assign('categories', $categories);
        $smarty->assign('product', $product);
        $smarty->display('products/edit.tpl');
    }

    public function add()
    {
        if (Request::isPost()) {
            $productData = Product::getDataFromPost();
            $productRepository = new Product\ProductRepository();
            $product = $productRepository->getProductFromArray($productData);

            $product = $productRepository->save($product);

            $productId = $product->getId();

            /* START ЗАГРУЗКА ПО URL */
            $imageUrl = trim($_POST['image_url']);
            ProductImage::uploadImageByUrl($productId, $imageUrl);
            /* END ЗАГРУЗКА ПО URL */

            /* START ЗАГРУЗКА С ДИСКА*/
            $uploadImages = $_FILES['images'] ?? [];
            ProductImage::uploadImages($productId, $uploadImages);
            /* END ЗАГРУЗКА С ДИСКА*/

            if ($productId) {
                Response::redirect('/products/list');
            } else {
                die("some insert error");
            }
        }

        $categories = Category::getList();
        $product = new Product\ProductModel('', 0, 0);
        $category = new Category\CategoryModel('');
        $product->setCategory($category);

        $smarty = \App\Renderer::getSmarty();

        $smarty->assign('categories', $categories);
        $smarty->assign('product', $product);
        $smarty->display('products/add.tpl');
    }

    public function delete()
    {
        $id = Request::getIntFromPost('id', false);

        if (!$id) {
            die('Error with id');
        }

        $deleted = Product::deleteById($id);

        if ($deleted) {
            Response::redirect('/products/list');
        } else {
            die("some error with delete row");
        }
    }

    public function deleteImage()
    {
        $productImageId = Request::getIntFromPost('product_image_id', false);

        if ( !$productImageId ) {
            die('Error with id');
        }

        $deleted = ProductImage::deleteById($productImageId);
        die('ok');

//        if ($deleted) {
//            Response::redirect('/products/list');
//        } else {
//            die('some error with delete row');
//        }
    }
}