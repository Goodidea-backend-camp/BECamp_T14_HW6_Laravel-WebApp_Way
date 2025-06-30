<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderRecord;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Collection;

class OrderRepository implements OrderRepositoryInterface
{
    public function create(object $updateData, int $userId)
    {
        return Order::create([
            'store_id' => $updateData->store_id,
            'create_user_id' => $userId,
            'created_at' => $updateData->start_time,
            'end_at' => $updateData->end_time,
        ]);
    }

    public function findManagedOrdersInfoByUserId(int $userId): Collection
    {
        return Order::where('create_user_id', $userId)
            ->with('store:id,name,phone,address')
            ->select('id', 'store_id', 'end_at')
            ->get()
            ->map(function ($order) {
                return [
                    'order_id' => $order->id,
                    'name' => $order->store->name,
                    'phone' => $order->store->phone,
                    'address' => $order->store->address,
                    'end_at' => $order->end_at,
                ];
            });
    }

    public function findParticipatedOrdersInfoByUserId(int $userId): Collection
    {
        $participatOrderIds = OrderRecord::where('user_id', $userId)
            ->distinct()
            ->pluck('order_id');
        if ($participatOrderIds->isEmpty()) {
            return collect();
        }
        return Order::wherein('id', $participatOrderIds)
            ->with('store:id,name,phone,address')
            ->select('id', 'store_id', 'end_at')
            ->get()
            ->map(function ($order) {
                return [
                    'order_id' => $order->id,
                    'name' => $order->store->name,
                    'phone' => $order->store->phone,
                    'address' => $order->store->address,
                    'end_at' => $order->end_at,
                ];
            });
    }

    public function findOrderInfoByOrderId(int $orderId, int $userId)
    {
        $isOrderOwner = Order::where('id', $orderId)
            ->where('create_user_id', $userId)
            ->first();

        if ($isOrderOwner) {
            $allOrderRecords = OrderRecord::where('order_id', $orderId)
                ->with('product:id,name,property', 'user:id,username')
                ->select('product_id', 'number', 'total_price', 'is_paid', 'description', 'user_id')
                ->get();

            // 過濾訂單擁有者自己的紀錄
            $ownerRecords = $allOrderRecords->filter(function ($record) use ($userId) {
                return $record->user_id === $userId;
            })->map(function ($orderRecord) {
                return [
                    'id' => $orderRecord->product_id,
                    'product_name' => $orderRecord->product->name,
                    'number' => $orderRecord->number,
                    'total_price' => $orderRecord->total_price,
                    'is_paid' => $orderRecord->is_paid,
                    'description' => $orderRecord->description,
                    'property' => $orderRecord->product->property,
                ];
            });

            // 過濾出其他參與者的紀錄
            $otherParticipantsRecords = $allOrderRecords->filter(function ($record) use ($userId) {
                return $record->user_id !== $userId;
            })->map(function ($orderRecord) {
                return [
                    'id' => $orderRecord->product_id,
                    'user_name' => $orderRecord->user->username,
                    'product_name' => $orderRecord->product->name,
                    'number' => $orderRecord->number,
                    'total_price' => $orderRecord->total_price,
                    'is_paid' => $orderRecord->is_paid,
                    'description' => $orderRecord->description,
                    'property' => $orderRecord->product->property,
                ];
            });

            return [
                'myOrderRecords' => $ownerRecords,
                'otherParticipantsRecords' => $otherParticipantsRecords,
            ];
        } else {
            // 用戶非擁有者，只返回該用戶的紀錄
            $myOrderRecords = OrderRecord::where('order_id', $orderId)
                ->where('user_id', $userId)
                ->with('product:id,name,property')
                ->select('product_id', 'number', 'total_price', 'is_paid', 'description')
                ->get()
                ->map(function ($orderRecord) {
                    return [
                        'id' => $orderRecord->product_id,
                        'product_name' => $orderRecord->product->name,
                        'number' => $orderRecord->number,
                        'total_price' => $orderRecord->total_price,
                        'is_paid' => $orderRecord->is_paid,
                        'description' => $orderRecord->description,
                        'property' => $orderRecord->product->property,
                    ];
                });

            return [
                'myOrderRecords' => $myOrderRecords,
            ];
        }
    }

    public function findStoreIdByOrderId(int $orderId)
    {
        return Order::where('id', $orderId)
            ->value('store_id');
    }
}
