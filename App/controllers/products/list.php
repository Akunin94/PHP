<?php

$current_page = Request::getIntFromGet('p', 1);

$limit = 4;
$offset = (int) (($current_page - 1) * $limit);

$products_count = Product::getListCount();
$page_count = ceil($products_count / $limit);

$products = Product::getList($limit, $offset);

$smarty->assign('pages_count', $page_count);
$smarty->assign('products', $products);
$smarty->display('products/index.tpl');