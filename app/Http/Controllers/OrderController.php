<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupOrderRequest;
use App\Http\Requests\OrderRequest;
use App\Models\User;
use App\Services\OrderService;
use App\Services\StoreService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $storeService;

    public function __construct(OrderService $orderService, StoreService $storeService)
    {
        $this->orderService = $orderService;
        $this->storeService = $storeService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $path = $request->path();
        $orders = collect();
        $ownOrders = collect();
        if ($path === 'dinbandon') {
            // 取的使用者參與的團購單資訊
            $orders = $this->orderService->getParticipatedOrdersInfoByUserId($userId);
        } else {
            // 取得使用者負責的團購單資訊
            $ownOrders = $this->orderService->getManagedOrdersInfoByUserId($userId);
            // 取的使用者參與的團購單資訊
            $orders = $this->orderService->getParticipatedOrdersInfoByUserId($userId);
        }

        return view('bandon', compact('orders', 'ownOrders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupOrderRequest $request)
    {
        $userId = $request->user()->id;
        $this->orderService->storeGroupOrder($request, $userId);

        return redirect('/dinbandon/orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $userId = $request->user()->id;
        $storeId = $this->orderService->getStoreIdByOrderId($id);
        $storeInfo = $this->storeService->getStore($storeId);
        $storeMenu = $this->storeService->getMenu($storeId);
        $userOrder = $this->orderService->getOrderInfoByOrderId($id, $userId);

        $responseData = collect([
            'order_id' => $id,
            'store_id' => $storeId,
            'storeInfo' => $storeInfo,
            'storeMenu' => $storeMenu,
            'userOrder' => $userOrder,
        ]);

        return view('orders', compact('responseData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $orderId = $validatedData['order_id'];
        $storeId = $validatedData['store_id'];
        $userId = $request->user()->id;
        $orders = collect($validatedData['orders']);

        [$numericOrders, $tempOrders] = $orders->partition(function ($order) {
            return is_numeric($order['id']);
        });

        $originalOrders = $this->orderService->updateOriginOrder($userId, $orderId, $numericOrders);
        $newOrders = $this->orderService->storeNewOrder($userId, $orderId, $storeId, $tempOrders);

        return redirect('/dinbandon/orders/' . $orderId);
    }

    public function storeInfo()
    {
        $stores = $this->storeService->getAllStores();

        return view('add-order', compact('stores'));
    }
}
