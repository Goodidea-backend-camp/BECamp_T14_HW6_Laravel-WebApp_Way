<?php

namespace App\Repositories;

use App\Models\OrderRecord;
use App\Repositories\Interfaces\OrderRecordRepositoryInterface;

class OrderRecordRepository implements OrderRecordRepositoryInterface
{
    public function all()
    {
        $products = OrderRecord::Paginate(10);
        return $products;
    }

    public function getOrderId(int $userId)
    {
        return OrderRecord::select('order_id')->where('user_id', $userId)->get();
    }

    public function create(array $data)
    {
        return OrderRecord::create($data);
    }
}
