<?php 

class Category {
	public static function getList() {
		$query = "SELECT * FROM categories";
		$result = Db::query($query);

		$categories = [];
		while ( $row = mysqli_fetch_assoc($result) ) {
		    $categories[] = $row;
		}

		return $categories;
	}

	public static function getById($id) {
	    $query = "SELECT * FROM categories WHERE id = $id";
	    $result = Db::query($query);

	    $category = mysqli_fetch_assoc($result);
	    if ( is_null($category) ) {
	        $category = [];
	    }

	    return $category;
	}

	public static function updateCategoryById($id, $category) { 
		$name = $category['name'] ?? '';

	    $query = "UPDATE categories SET name = '$name' WHERE id = $id";
	    Db::query($query);

	    return Db::affectedRows();

	}

	public static function add($category) { 
		$name = $category['name'] ?? '';

	    $query = "INSERT INTO categories(name) VALUES ('$name')";
	    Db::query($query);

	    return Db::affectedRows();
	}

	public static function deleteCategoryById($id) {
		$query = "DELETE FROM categories WHERE id = $id";
		Db::query($query);

		return Db::affectedRows();
	}

	public static function deleteAllProducts($id) {
		$query = "DELETE FROM products WHERE category_id = $id";
		Db::query($query);

		return Db::affectedRows();
	}

	public static function getFromPost () {
		return [
		    'id' => $_POST['id'] ?? '',
		    'name' => $_POST['name'] ?? ''
	    ];
	}
}