<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = Category::deleteAllProducts($connect, $id);

if ($deleted) {
    header('Location: /categories/list');
} else {
    die("Нечего удалять");
}