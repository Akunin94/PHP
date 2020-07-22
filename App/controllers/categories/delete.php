<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = Category::deleteById($connect, $id);

if ($deleted) {
    header('Location: /categories/list');
} else {
    die("some error with delete");
}