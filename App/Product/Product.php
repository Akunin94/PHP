<?php

namespace App\Product;

use App\Category\Category;

class Product {
    /**
     * @var int
     */
	protected $id;

    /**
     * @var string
     */
	protected $name;

    /**
     * @var string
     */
	protected $article;

    /**
     * @var float
     */
	protected $price;

    /**
     * @var int
     */
	protected $amount;

    /**
     * @var string
     */
	protected $description;

    /**
     * @var Category
     */
	protected $category;

    /**
     * @var array
     */
	protected $images;

	public function getId() {
		return $this->id;
	}

	public function __construct(string $name, float $price, int $amount) {
        $this->setName($name);
        $this->setPrice($price);
        $this->setAmount($amount);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticle(): string
    {
        return $this->article;
    }

    /**
     * @param string $article
     * @return Product
     */
    public function setArticle(string $article): Product
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Product
     */
    public function setPrice(float $price): Product
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Product
     */
    public function setAmount(int $amount): Product
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function setCategory(Category $category): Product
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return array
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @param array $images
     * @return Product
     */
    public function setImages(array $images): Product
    {
        $this->images = $images;
        return $this;
    }

	public function setId(int $id) {
		$this->id = $id;

		return $this;
	}
}