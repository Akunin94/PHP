<?php

use App\Request;
use App\Response;
use App\Product;
use App\ProductImage;
use App\Category;

$productId = Request::getIntFromGet('id');

$product = [];

$productRepository = new Product\ProductRepository();

if ( $productId ) {
    $product = $productRepository->getById($productId);
}

if ( Request::isPost() ) {
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

$smarty->assign('categories', $categories);
$smarty->assign('product', $product);
$smarty->display('products/edit.tpl');