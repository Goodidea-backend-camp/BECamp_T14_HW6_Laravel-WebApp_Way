<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface OrderRepositoryInterface
{
    public function findManagedOrdersInfoByUserId(int $userId): Collection;
    public function findParticipatedOrdersInfoByUserId(int $userId): Collection;
    public function findOrderInfoByOrderId(int $orderId, int $userId);
    public function findStoreIdByOrderId(int $orderId);
}
