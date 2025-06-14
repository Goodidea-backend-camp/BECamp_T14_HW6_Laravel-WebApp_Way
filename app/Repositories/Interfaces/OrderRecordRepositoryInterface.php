<?php

namespace App\Repositories\Interfaces;

interface OrderRecordRepositoryInterface
{
    public function all();
    public function getOrderId(int $storeId);
    public function create(array $data);
    public function update(array $data);
}
