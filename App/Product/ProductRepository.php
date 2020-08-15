<?php

namespace App\Product;

use App\Category;
use App\Db\Db;
use App\ProductImage;

/**
 * @param int $limit
 * @param int $offset
 * $return Product[]
 */

class ProductRepository {
    public function getProductFromArray(array $data): Product {
        $id = $data['id'];

        $name = $data['name'] ?? null;
        $price = $data['price'] ?? null;
        $amount = $data['amount'] ?? null;

        if (is_null($name) || is_null($price) ||is_null($amount)) {
            throw new \Exception('Не переданы одно из полей name, price, amount');
        }

        $article = $data['article'] ?? '';
        $description = $data['description'] ?? '';
        $categoryId = $data['category_id'] ?? 0;

        $product = new Product($name, $price, $amount);

        if ($categoryId > 0) {
            $categoryName = $data['category_name'] ?? '';
            $category = new Category\Category($categoryName);
            $category->setId($categoryId);

            $product->setCategory($category);
        }
        $product
            ->setId($id)
            ->setDescription($description)
            ->setArticle($article);
//                ->setCategoryId($categoryId);

        return $product;
    }
    public function getList(int $limit = 50, $offset = 0) {
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";

        $result =  Db::query($query);

        $products = [];
        while ($productArray = Db::fetchAssoc($result)) {
            $product = $this->getProductFromArray($productArray);

            $products[] = $product;
        }

//        foreach ($products as &$product) {
//            $images = ProductImage::getListByProductId($product['id']);
//            $product['images'] = $images;
//        }

        return $products;
    }
}