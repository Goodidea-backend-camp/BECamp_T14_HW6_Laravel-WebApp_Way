<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\StoreRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StoreService
{
    protected $storeRepository;
    protected $productRepository;

    public function __construct(StoreRepositoryInterface $storeRepository, ProductRepositoryInterface $productRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllStores()
    {
        return $this->storeRepository->all();
    }

    public function getStore(int $storeId)
    {
        return $this->storeRepository->getStoreInfofByStoreId($storeId);
    }

    public function getStoresByIds(array $id)
    {
        return $this->storeRepository->getByIds($id);
    }

    public function getMenu(int $storeId)
    {
        return  $this->storeRepository->getMenuByStoreId($storeId);;
    }

    public function createStore(array $data)
    {
        return $this->storeRepository->create($data);
    }

    public function insertProduct(array $data)
    {
        return $this->productRepository->createMany($data);
    }
}
