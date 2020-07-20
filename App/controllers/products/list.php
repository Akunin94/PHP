<?php

$current_page = (int) ($_GET['p'] ?? 0);

$limit = 4;
$offset = (int) (($current_page - 1) * $limit);
$products_count = get_product_list_count($connect);

if ($offset < 0) {
	$offset = 0;
}

$page_count = ceil($products_count / $limit);
$products = get_product_list($connect, $limit, $offset);

$smarty->assign('pages_count', $page_count);
$smarty->assign('products', $products);
$smarty->display('products/index.tpl');