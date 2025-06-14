<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRecordRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    protected $orderRepository;
    protected $orderRecordRepository;
    protected $productRepository;
    public function __construct(OrderRepositoryInterface $orderRepository, OrderRecordRepositoryInterface $orderRecordRepository, ProductRepositoryInterface $productRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderRecordRepository = $orderRecordRepository;
        $this->productRepository = $productRepository;
    }

    public function getStoreIdByOrderId(int $orderId)
    {
        return $this->orderRepository->findStoreIdByOrderId($orderId);
    }

    public function getManagedOrdersInfoByUserId(int $userId)
    {
        return $this->orderRepository->findManagedOrdersInfoByUserId($userId);
    }

    public function getParticipatedOrdersInfoByUserId(int $userId)
    {
        return $this->orderRepository->findParticipatedOrdersInfoByUserId($userId);
    }

    public function getOrderInfoByOrderId(int $orderId, int $userId)
    {
        return $this->orderRepository->findOrderInfoByOrderId($orderId, $userId);
    }

    public function updateOriginOrder(int $userId, int $orderId, object $items)
    {
        $updateData = [];
        foreach ($items as $item) {
            $updateData[] = [
                'order_id' => $orderId,
                'user_id' => $userId,
                'product_id' => $item['id'],
                'number' => $item['number'],
                'total_price' => $item['total_price'],
                'is_paid' => $item['is_paid'],
                'description' => $item['description'],
            ];
        }
        $this->orderRecordRepository->update($updateData);
    }

    public function storeNewOrder(int $userId, int $orderId, int $storeId, object $items)
    {
        $updateData = [];
        foreach ($items as $item) {
            $updateData[] = [
                'order_id' => $orderId,
                'user_id' => $userId,
                'product_id' => $this->productRepository->getProductId($storeId, $item['product_name'], $item['product_property']),
                'number' => $item['number'],
                'total_price' => $item['total_price'],
                'is_paid' => $item['is_paid'],
                'description' => $item['description'],
            ];
        }

        $this->orderRecordRepository->create($updateData);
    }

    public function storeGroupOrder(object $updateData, int $userId)
    {
        return $this->orderRepository->create($updateData, $userId);
    }
}
