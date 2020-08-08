<?php 

use App\Category;
use App\Request;
use App\Product;

$category_id = Request::getIntFromGet('id', false);

$category = Category::getById($category_id);
$products = Product::getListByCategory($category_id);

$smarty->assign('current_category', $category);
$smarty->assign('products', $products);
$smarty->display('categories/view.tpl');