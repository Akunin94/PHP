<?php

use App\Category;
use App\Request;
use App\Response;

$category_id = Request::getIntFromPost('id', false);

if ( !$category_id ) {
    die('Error with id');
}

$deleted = Category::deleteById($category_id);

if ($deleted) {
    Response::redirect('/categories/list');
} else {
    die("some error with delete");
}