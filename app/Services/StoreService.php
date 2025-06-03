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

    public function getStore($id)
    {
        $store = Store::select('name', 'phone', 'address', 'description')->where('id', $id)->first();

        return $store;
    }

    public function getMenu($id)
    {
        $menus = Product::select('id', 'name', 'property', 'price')->where('store_id', $id)->orderBy('name')->get();

        return $menus;
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
