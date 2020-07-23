<?php

$id = Request::getIntFromPost('id', false);

if ( !$id ) {
    die('Error with id');
}

$deleted = Category::deleteById($id);

if ($deleted) {
    Response::redirect('/categories/list');
} else {
    die("some error with delete");
}