<?php

if ( Request::isPost() ) {
    $category = Category::getFromPost();
    $inserted = Category::add($category);

    if ($inserted) {
        Response::redirect('/categories/list');
    } else {
        die("some insert error");
    }
}
$smarty->display('categories/add.tpl');