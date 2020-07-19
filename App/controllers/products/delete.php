<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = delete_product_by_id($connect, $id);

if ($deleted) {
    header('Location: /products/list');
} else {
    die("some error with delete");
}