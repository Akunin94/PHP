<?php

$id = $_POST['id'] ?? '';
$id = (int) $id;

if ( !$id ) {
    die('Error with id');
}

$deleted = delete_category_by_id($connect, $id);

if ($deleted) {
    header('Location: /categories/list');
} else {
    die("some error with delete");
}