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
        return OrderRecord::insert($data);
    }

    public function update(array $data)
    {
        foreach ($data as $item) {
            OrderRecord::where([
                'order_id' => $item['order_id'],
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'description' => $item['description'],
            ])->update([
                'number' => $item['number'],
                'total_price' => $item['total_price'],
                'is_paid' => $item['is_paid'],
                'description' => $item['description']
            ]);
        }
        return true;
    }
}
