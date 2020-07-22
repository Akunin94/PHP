<?php

if ( !empty($_POST) ) {
    $product = Product::getDataFromPost();
    $inserted = Product::add($product);

    if ($inserted) {
        header('Location: /products/list');
    } else {
        die("some insert error");
    }
}

$categories = Category::getList();

$smarty->assign('categories', $categories);
$smarty->display('products/add.tpl');