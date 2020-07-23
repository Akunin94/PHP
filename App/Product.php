<?php 

class Product {	
	public static function getListCount() {
		$query = "SELECT COUNT(1) AS c FROM products p LEFT JOIN categories c ON p.category_id = c.id";

		return Db::fetchOne($query);
	}

	public static function getList(int $limit = 100, int $offset = 0) {
		$query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";

		return Db::fetchAll($query);
	}

	public static function getById($id) {
	    $query = "SELECT p.*, c.id as category_id FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = $id";
	    
	    return Db::fetchRow($query);
	}

	public static function updateById(int $id, array $product): int { 
		return Db::update('products', $product, "id = $id" );
	}

	public static function add(array $product): int {
		if ( isset($product['id']) ) {
			unset($product['id']);
		}
		
	    return Db::insert('products', $product);
	}

	public static function deleteById(int $id) {		
		return Db::delete('products', "id = $id");
	}

	public static function getDataFromPost () {

		return [
		    'id' => Request::getIntFromPost('id', false),
		    'name' => Request::getStrFromPost('name'),
		    'article' => Request::getStrFromPost('article'),
		    'price' => Request::getIntFromPost('price'),
		    'amount' => Request::getIntFromPost('amount'),
		    'category_id' => Request::getStrFromPost('category_id'),
		    'description' => Request::getStrFromPost('description'),
	    ];
	}

	public static function getListByCategory($category_id) {
		$query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.category_id = $category_id";

		return Db::fetchAll($query);
	}

}