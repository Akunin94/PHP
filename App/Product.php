<?php 

function get_product_list($connect) {
	$query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id";
	$result = query($connect, $query);

	$products = [];
	while ( $row = mysqli_fetch_assoc($result) ) {
	    $products[] = $row;
	}

	return $products;
}

function get_product_by_id($connect, $id) {
    $query = "SELECT p.*, c.id as category_id FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = $id";
    $result = query($connect, $query);

    $product = mysqli_fetch_assoc($result);
    if ( is_null($product) ) {
        $product = [];
    }

    return $product;
}

function update_product_by_id($connect, $id, $product) { 
	$name = $product['name'] ?? '';
	$article = $product['article'] ?? '';
	$price = $product['price'] ?? '';
	$amount = $product['amount'] ?? '';
	$category_id = $product['category_id'] ?? '';
	$description = $product['description'] ?? '';

    $query = "UPDATE products SET name = '$name', article = '$article', price = '$price', amount = '$amount', category_id = '$category_id', description = '$description' WHERE id = $id";
    query($connect, $query);

    return mysqli_affected_rows($connect);

}

function add_product($connect, $product) { 
	$name = $product['name'] ?? '';
	$article = $product['article'] ?? '';
	$price = $product['price'] ?? '';
	$amount = $product['amount'] ?? '';
	$category_id = $product['category_id'] ?? '';
	$description = $product['description'] ?? '';

    $query = "INSERT INTO products(name, article, price, amount, category_id, description) VALUES ('$name', '$article', '$price', '$amount', '$category_id', '$description')";
    query($connect, $query);

    return mysqli_affected_rows($connect);
}

function delete_product_by_id($connect, $id) {
	$query = "DELETE FROM products WHERE id = $id";
	query($connect, $query);

	return mysqli_affected_rows($connect);
}

function get_product_from_post () {
	return [
	    'id' => $_POST['id'] ?? '',
	    'name' => $_POST['name'] ?? '',
	    'article' => $_POST['article'] ?? '',
	    'price' => $_POST['price'] ?? '',
	    'amount' => $_POST['amount'] ?? '',
	    'category_id' => $_POST['category_id'] ?? '',
	    'description' => $_POST['description'] ?? ''
    ];
}