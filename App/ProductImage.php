<?php 

class ProductImage {
	public static function getById(int $id) {
	    $query = "SELECT * FROM product_images WHERE id = $id";
	    
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
		return Db::delete('product_images', "id = $id");
	}

	public static function deleteByProductId(int $productId) {		
		return Db::delete('product_images', "product_id = $productId");
	}

	public static function getListByProductId(int $productId) {	
	    $query = "SELECT * FROM product_images WHERE product_id = $productId";
	    
	    return Db::fetchAll($query);
	}

	// public static function getDataFromPost () {

	// 	return [
	// 	    'id' => Request::getIntFromPost('id', false),
	// 	    'name' => Request::getStrFromPost('name'),
	// 	    'article' => Request::getStrFromPost('article'),
	// 	    'price' => Request::getIntFromPost('price'),
	// 	    'amount' => Request::getIntFromPost('amount'),
	// 	    'category_id' => Request::getStrFromPost('category_id'),
	// 	    'description' => Request::getStrFromPost('description'),
	//     ];
	// }

}