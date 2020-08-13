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
    public function getList(int $limit = 50, $offset = 0) {
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";

        $result =  Db::query($query);

        $products = [];
        while ($productArray = Db::fetchAssoc($result)) {
            $id = $productArray['id'];

            $name = $productArray['name'];
            $price = $productArray['price'];
            $amount = $productArray['amount'];

            $article = $productArray['article'] ?? '';
            $description = $productArray['description'] ?? '';
            $categoryId = $productArray['category_id'] ?? 0;

            $product = new Product($name, $price, $amount);

            if ($categoryId > 0) {
                $categoryName = $productArray['category_name'] ?? '';
                $category = new Category($categoryName);
                $category->setId($categoryId);

                $product->setCategory($category);
            }
            $product
                ->setId($id)
                ->setDescription($description)
                ->setArticle($article);
//                ->setCategory($categoryId);

            $products[] = $product;
        }

//        foreach ($products as &$product) {
//            $images = ProductImage::getListByProductId($product['id']);
//            $product['images'] = $images;
//        }

        return $products;
    }
}