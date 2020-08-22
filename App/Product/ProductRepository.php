<?php

namespace App\Product;

use App\Category;
use App\Db\Db;
use App\ProductImage as ProductImageService;

/**
 * @param int $limit
 * @param int $offset
 * $return Product[]
 */
class ProductRepository
{
    public function getById(int $id) {
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = $id";
        $productArray = Db::fetchRow($query);
        $product = $this->getProductFromArray($productArray);

        $imagesData = ProductImageService::getListByProductId($product->getId());
        foreach ($imagesData as $imageItem) {
            $productImage = $this->getProductImageFromArray($imageItem);
            $product->addImage($productImage);
        }

        return $product;
    }

    public function getList(int $limit = 50, $offset = 0)
    {
        $query = "SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id LIMIT $offset, $limit";
        $result = Db::query($query);

        $products = [];
        while ($productArray = Db::fetchAssoc($result)) {
            $product = $this->getProductFromArray($productArray);

            $imagesData = ProductImageService::getListByProductId($product->getId());
            foreach ($imagesData as $imageItem) {
                $productImage = $this->getProductImageFromArray($imageItem);
                $product->addImage($productImage);
            }

            $products[] = $product;
        }

        return $products;
    }

    public function save(ProductModel $product): ProductModel
    {
        $id = $product->getId();
        $productArray = $this->productToArray($product);

        if ($id) {
            Db::update('products', $productArray, "id = $id");

            return $product;
        }

        $id = Db::insert('products', $productArray);
        $product->setId($id);

        return $product;
    }

    public function productToArray(ProductModel $product)
    {
        $data = [
            'name' => $product->getName(),
            'article' => $product->getArticle(),
            'amount' => $product->getAmount(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
        ];

        $category = $product->getCategory();
        if (!is_null($category)) {
            $data['category_id'] = $category->getId();
        }

        return $data;
    }

    /**
     * @param array $data
     * @return ProductModel
     */
    public function getProductFromArray(array $data): ProductModel
    {
        $id = $data['id'];

        $name = $data['name'] ?? null;
        $price = $data['price'] ?? null;
        $amount = $data['amount'] ?? null;

        if (is_null($name) || is_null($price) || is_null($amount)) {
            throw new \Exception('Не переданы одно из полей name, price, amount');
        }

        $article = $data['article'] ?? '';
        $description = $data['description'] ?? '';
        $categoryId = $data['category_id'] ?? 0;

        $product = new ProductModel($name, $price, $amount);

        if ($categoryId > 0) {
            $categoryName = $data['category_name'] ?? null;
            if (is_null($categoryName)) {
                $categoryData = \App\Category::getById($categoryId);
                $categoryName = $categoryData['name'];
            }
            $category = new Category\CategoryModel($categoryName);
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

    /**
     * @param array $data
     * @return ProductImageModel
     */

    public function getProductImageFromArray(array $data): ProductImageModel
    {
        $productImage = new ProductImageModel();

        $productImage
            ->setId($data['id'])
            ->setName($data['name'])
            ->setPath($data['path'])
            ->setSize($data['size']);

        return $productImage;
    }
}