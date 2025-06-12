<?php

namespace App\Repositories\Interfaces;

interface StoreRepositoryInterface
{
    public function all();
    public function getByIds(array $id);
    public function create(array $data);
    public function getMenuByStoreId(int $storeId);
    public function getStoreInfofByStoreId(int $storeId);
}
