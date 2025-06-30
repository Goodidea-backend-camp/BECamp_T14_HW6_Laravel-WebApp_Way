<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Store;
use App\Repositories\Interfaces\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    public function all()
    {
        $stores = Store::Paginate(10);
        return $stores;
    }

    public function getByIds(array $id)
    {
        return Store::select('name', 'phone', 'address', 'description')
            ->whereIn('id', $id)
            ->get();
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function getMenuByStoreId(int $storeId)
    {
        return Product::select('id', 'name', 'property', 'price')
            ->where('store_id', $storeId)
            ->orderBy('name')
            ->get()
            ->map(function ($menu) {
                return [
                    'name' => $menu->name,
                    'property' => $menu->property,
                    'price' => $menu->price,
                ];
            });
    }

    public function getStoreInfofByStoreId(int $storeId)
    {
        return Store::select('name', 'phone', 'address', 'description')
            ->where('id', $storeId)
            ->get()
            ->map(function ($storeInfo) {
                return [
                    'name' => $storeInfo->name,
                    'phone' => $storeInfo->phone,
                    'address' => $storeInfo->address,
                    'description' => $storeInfo->description,
                ];
            });
    }
}
