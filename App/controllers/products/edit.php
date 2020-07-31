<?php

$productId = Request::getIntFromGet('id');

$product = [];

if ( $productId ) {
    $product = Product::getById($productId);
}

if ( Request::isPost() ) {
    $productData = Product::getDataFromPost();
    $edited = Product::updateById($productId, $productData);

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