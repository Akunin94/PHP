<?php

$productImageId = Request::getIntFromPost('product_image_id', false);

if ( !$productImageId ) {
    die('Error with id');
}

$deleted = ProductImage::deleteById($productImageId);
die('ok');