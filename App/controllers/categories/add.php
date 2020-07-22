<?php

if ( !empty($_POST) ) {
    $category = Category::getFromPost();
    $inserted = Category::add($connect, $category);

    if ($inserted) {
        header('Location: /categories/list');
    } else {
        die("some insert error");
    }
}
$smarty->display('categories/add.tpl');