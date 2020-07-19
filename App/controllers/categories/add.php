<?php

if ( !empty($_POST) ) {
    $category = get_category_from_post();
    $inserted = add_category($connect, $category);

    if ($inserted) {
        header('Location: /categories/list');
    } else {
        die("some insert error");
    }
}
$smarty->display('categories/add.tpl');