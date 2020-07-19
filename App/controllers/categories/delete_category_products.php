<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = delete_products_of_category($connect, $id);

if ($deleted) {
    header('Location: /categories/list');
} else {
    die("Нечего удалять");
}