<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Product;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeService->getAllStores();

        return view('all-bandon', ['stores' => $stores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        // 商店資訊寫入資料庫
        $storeData = [
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'description' => $validatedData['description'],
        ];
        $store = $this->storeService->createStore($storeData);

        // 商品寫入資料庫
        if (isset($validatedData['menu']) && is_array($validatedData['menu'])) {
            $productData = [];
            foreach ($validatedData['menu'] as $menuData) {
                $productData[] = [
                    'store_id' => $store->id,
                    'name' => $menuData['name'],
                    'property' => $menuData['property'],
                    'price' => $menuData['price'],
                ];
            }
            $this->storeService->insertProduct($productData);
        }
        return redirect('dinbandon/stores')->with('success', '已成功新增店家資訊');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menus = $this->storeService->getMenu($id);
        $storeInfo = $this->storeService->getStore($id);

        return view('store', [
            'storeInfo' => $storeInfo,
            'menus' => $menus
        ]);
    }
}
