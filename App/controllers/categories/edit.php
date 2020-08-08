<?php

use App\Category;
use App\Request;
use App\Response;

$id = Request::getIntFromGet('id');

$category = [];

if ( $id ) {
    $category = Category::getById($id);
}

if ( Request::isPost() ) {
    $category = Category::getFromPost();

    $edited = Category::updateById($id, $category);

    if ($edited) {
        Response::redirect('/categories/list');
    } else {
        die("some insert error");
    }
}

$smarty->assign('category', $category);
$smarty->display('categories/edit.tpl');