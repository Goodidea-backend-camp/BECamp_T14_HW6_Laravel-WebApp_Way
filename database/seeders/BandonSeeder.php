<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderRecord;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BandonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Store::factory(20)->create();
        Product::factory(300)->create();
        Order::factory(50)->create();
        OrderRecord::factory(50)->create();
    }
}
