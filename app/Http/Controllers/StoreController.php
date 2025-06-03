<?php

namespace App\Http\Controllers;

use App\Http\Requests\Http\Requests\StoreRequest;
use App\Models\Product;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeSerivce;
    protected $productSerivce;

    public function __construct(StoreService $storeSerivce)
    {
        $this->storeSerivce = $storeSerivce;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeSerivce->getAllStores();

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
        $store = $this->storeSerivce->createStore($storeData);

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
            $this->storeSerivce->insertProduct($productData);
        }
        return redirect('dinbandon/stores')->with('success', '已成功新增店家資訊');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menus = $this->storeSerivce->getMenu($id);
        $storeInfo = $this->storeSerivce->getStore($id);

        return view('store', [
            'storeInfo' => $storeInfo,
            'menus' => $menus
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
