<?php

use App\Category;
use App\Product;
use App\ProductImage;
use App\Request;
use App\Response;

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

$smarty->assign('categories', $categories);
$smarty->display('products/add.tpl');