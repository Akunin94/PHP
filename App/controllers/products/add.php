<?php

if ( Request::isPost() ) {

    $product = Product::getDataFromPost();
    $productId = Product::add($product);

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

$smarty->assign('categories', $categories);
$smarty->display('products/add.tpl');