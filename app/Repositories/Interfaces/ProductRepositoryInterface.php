<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function createMany(array $data);
    public function getProductId(int $storeId, string $productName, string $productProperty);
}
