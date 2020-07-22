<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = Product::deleteById($id);

if ($deleted) {
    header('Location: /products/list');
} else {
    die("some error with delete");
}