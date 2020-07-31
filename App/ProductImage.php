<?php 

class ProductImage {
	private CONST IMAGES_MIME_DICT = [
    	'image/apng' => '.apng',
    	'image/bmp' => '.bmp',
    	'image/agif' => '.gif',
    	'image/x-icon' => '.ico',
    	'image/jpeg' => '.jpg',
    	'image/png' => '.png',
    	'image/svg+xml' => '.svg',
    	'image/tiff' => '.tiff',
    	'image/webp' => '.webp',
	];

	public static function getById(int $id) {
	    $query = "SELECT * FROM product_images WHERE id = $id";
	    
	    return Db::fetchRow($query);
	}

	public static function findByFilenameInProduct(int $productId, string $filename) {
	    $query = "SELECT * FROM product_images WHERE product_id = $productId AND name = '$filename'";
	    
	    return Db::fetchRow($query);		
	}

	public static function updateById(int $id, array $productImage): int { 
		if ( isset($productImage['id']) ) {
			unset($productImage['id']);
		}
		
		return Db::update('product_images', $productImage, "id = $id" );
	}

	public static function add(array $product): int {
		if ( isset($product['id']) ) {
			unset($product['id']);
		}
		
	    return Db::insert('product_images', $product);
	}

	public static function deleteById(int $id) {
		$productImage = static::getById($id);
		$filepath = APP_PUBLIC_DIR . $productImage['path'];
		if ( file_exists($filepath) ) {
			unlink($filepath);
		}

		return Db::delete('product_images', "id = $id");
	}

	public static function deleteByProductId(int $productId) {		
		return Db::delete('product_images', "product_id = $productId");
	}

	public static function getListByProductId(int $productId) {	
	    $query = "SELECT * FROM product_images WHERE product_id = $productId";
	    
	    return Db::fetchAll($query);
	}

	public static function uploadImages(int $productId, array $files) {
		$imageNames = $files['name'] ?? [];
		$imageTmpNames = $files['tmp_name'] ?? [];

		$imagesCount = 0;

		for ( $i = 0; $i < count($imageNames); $i++ ) {
			$result = static::uploadImage($productId, [
				'name' => $imageNames[$i],
				'tmp_name' => $imageTmpNames[$i]
			]);

			if ($result) {
				$imagesCount++;
			}
		}

		return $imagesCount;
	}

	protected static function getUniqueUploadImageName(int $productId, string $imageName) {
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

		return $filename;
	}

	public static function uploadImageByUrl(int $productId, string $imageUrl) {
		if (empty($imageUrl)) {
			return false;
		}

		$imageExt = static::getExtensionByUrl($imageUrl);

	    if ( is_null($imageExt) ) {
	    	return false;
	    }

    	$productImageId = ProductImage::add([
			'product_id' => $productId,
			'name' => '',
			'path' => ''
		]);
    	$filename = $productId . '_' . $productImageId . '_upload' . time() . $imageExt;

		$path = static::getUploadDirForProduct($productId);
    	$imagePath = $path . '/' . $filename;

    	file_put_contents($imagePath, fopen($imageUrl, 'r'));
    	
    	ProductImage::updateById($productImageId, [
    		'name' => $filename,
    		'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath)
    	]);

	    return true;
	}

	protected static function checkProductFolderExists(int $productId) {
		$path = APP_UPLOAD_PRODUCT_DIR . '/' . $productId;

		if ( !file_exists($path) ) {
			mkdir($path);
		}
	}

	protected static function getUploadDirForProduct(int $productId) {
		$path = APP_UPLOAD_PRODUCT_DIR . '/' . $productId;	

		if ( !file_exists($path) ) {
			mkdir($path);
		}
		
		return $path;	
	}

	protected static function getExtensionByUrl(string $url) {
	    $mimeType = static::getMimeTypeByUrl($url);

	    return static::IMAGES_MIME_DICT[$mimeType] ?? null;
	}

	protected statis function getMimeTypeByUrl(string $url) {
		$headers = @get_headers($url);

	    if ( $headers === false ) {
	    	return null;
	    }

	    $contentType = null;
	    foreach ($headers as $headerStr) {
	    	if (strpos(strtolower($headerStr), 'content-type') === false) {
	    		continue;
	    	}

	    	$header = explode(':', $headerStr);
	    	$contentType = trim(strtolower($header[1] ?? ''));
	    };
	}

	public static function uploadImage(int $productId, array $file) {
		$imageName = basename(trim($file['name']));

		if ( empty($imageName) ) {
			return false;
		}

		$imageTmpName = $file['tmp_name'];

		$filename = static::getUniqueUploadImageName($productId, $imageName);

		$path = static::getUploadDirForProduct($productId);
		$imagePath = $path . '/' . $imageName;

		move_uploaded_file($imageTmpName, $imagePath);
		
		ProductImage::add([
			'product_id' => $productId,
			'name' => $filename,
			'path' => str_replace(APP_PUBLIC_DIR, '', $imagePath)
		]);
		
		return true;
	}
}