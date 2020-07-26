<?php

$productId = Request::getIntFromGet('id');

$product = [];

if ( $productId ) {
    $product = Product::getById($productId);
}

if ( Request::isPost() ) {
    $productData = Product::getDataFromPost();
    $edited = Product::updateById($productId, $productData);

	$uploadImages = $_FILES['images'] ?? [];

	$imageNames = $uploadImages['name'];
	$imageTmpNames = $uploadImages['tmp_name'];

	$path = APP_UPLOAD_PRODUCT_DIR . '/' . $productId;

	if ( !file_exists($path) ) {
		mkdir($path);
	}

	for ( $i = 0; $i < count($imageNames); $i++ ) {
		$imageName = basename($imageNames[$i]);
		$imageTmpName = $imageTmpNames[$i];

		$filename = $imageName;
		$counter = 0;

		while (true) {
			$duplicateImage = ProductImage::findByFilenameInProduct($productId, $filename);

			if (empty($duplicateImage)) {
				break;
			}

			$info = pathinfo($imageName);
			$filename = $info['filename'];
			$filename .= '_' . $counter . '.' . $info['extension'];

			$counter++;
		}

		$imagePath = $path . '/' . $imageName;

		move_uploaded_file($imageTmpName, $imagePath);
		
		ProductImage::add([
			'product_id' => $productId,
			'name' => $filename,
			'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath)
		]);
	}

    
    Response::redirect('/products/list');
}

$categories = Category::getList();

$smarty->assign('categories', $categories);
$smarty->assign('product', $product);
$smarty->display('products/edit.tpl');