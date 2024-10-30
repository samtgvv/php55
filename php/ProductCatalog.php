<?php
class ProductCatalog
{
    private $products = [];

    public function addProduct($name, $price, $category, $ls)
    {
        $this->products[] = [
            'name' => $name,
            'price' => $price,
            'category' => $category,
            'ls' => $ls
        ];
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function searchProducts($keyword)
    {
        return array_filter($this->products, function ($product) use ($keyword) {
            return stripos($product['name'], $keyword) !== false;
        });
    }

    public function filterByCategory($category)
    {
        return array_filter($this->products, function ($product) use ($category) {
            return $product['category'] === $category;
        });
    }

    public function getCategories()
    {
        return array_unique(array_column($this->products, 'category'));
    }
}
