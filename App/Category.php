<?php 

function get_category_list($connect) {
	$query = "SELECT * FROM categories";
	$result = query($connect, $query);

	$categories = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
	    $categories[] = $row;
	}

	return $categories;
}

function get_category_by_id($connect, $id) {
    $query = "SELECT * FROM categories WHERE id = $id";
    $result = query($connect, $query);

    $category = mysqli_fetch_assoc($result);
    if ( is_null($category) ) {
        $category = [];
    }

    return $category;
}

function update_category_by_id($connect, $id, $category) { 
	$name = $category['name'] ?? '';

    $query = "UPDATE categories SET name = '$name' WHERE id = $id";
    query($connect, $query);

    return mysqli_affected_rows($connect);

}

function add_category($connect, $category) { 
	$name = $category['name'] ?? '';

    $query = "INSERT INTO categories(name) VALUES ('$name')";
    query($connect, $query);

    return mysqli_affected_rows($connect);
}

function delete_category_by_id($connect, $id) {
	$query = "DELETE FROM categories WHERE id = $id";
	query($connect, $query);

	return mysqli_affected_rows($connect);
}

function delete_products_of_category($connect, $id) {
	$query = "DELETE FROM products WHERE category_id = $id";
	query($connect, $query);

	return mysqli_affected_rows($connect);
}

function get_category_from_post () {
	return [
	    'id' => $_POST['id'] ?? '',
	    'name' => $_POST['name'] ?? ''
    ];
}