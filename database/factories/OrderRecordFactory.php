<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productId = Product::inRandomOrder()->first()->id;
        $number = fake()->numberBetween(1,8);
        $totalPrice = Product::where('id',$productId)->value('price') * $number;

        return [
            'order_id' => Order::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'product_id' => $productId,
            'number' => $number,
            'total_price' => $totalPrice,
            'is_paid' => fake()->numberBetween(0,1),
            'description' => fake()->text(),
        ];
    }
}
