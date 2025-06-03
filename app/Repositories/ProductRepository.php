<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        $products = Product::Paginate(10);
        return $products;
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function createMany(array $data)
    {
        return Product::insert($data);
    }
}
