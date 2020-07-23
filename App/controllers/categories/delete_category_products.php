<?php

$id = Request::getIntFromPost('id', false);

if ( !$id ) {
    die('Error with id');
}

$deleted = Category::deleteAllProducts($id);

if ($deleted) {
    Response::redirect('/categories/list');
} else {
    die("Нечего удалять");
}