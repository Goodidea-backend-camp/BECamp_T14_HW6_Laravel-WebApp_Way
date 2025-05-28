<?php

namespace App\Http\Controllers;

use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected $storeSerivce;

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd('1234');
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
