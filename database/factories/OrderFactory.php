<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeBetween('+1 days', '+10 days')->setTime(rand(8, 14), 0, 0);;
        $endAt = (clone $createdAt)->modify('+1 hours');
        
        return [
            'store_id' => Store::inRandomOrder()->first()->id,
            'create_user_id' => User::inRandomOrder()->first()->id,
            'created_at' => $createdAt,
            'end_at' => $endAt,
        ];
    }
}
