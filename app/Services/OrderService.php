<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRecordRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    protected $orderRepository;
    protected $orderRecordRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, OrderRecordRepositoryInterface $orderRecordRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderRecordRepository = $orderRecordRepository;
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
}
