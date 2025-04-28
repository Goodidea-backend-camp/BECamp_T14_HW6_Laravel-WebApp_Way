<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDay = fake()->dateTimeBetween('-3 days', '+10 days')->setTime(rand(8, 14), 0, 0);
        # 如果使用clone modify會去修改原本的數值，導致startDay跟endDay相等
        $endDay = (clone $startDay)->modify('+1 hours');
        return [
            'create_user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->catchPhrase(),
            'start_at' => $startDay,
            'end_at' => $endDay,
        ];
    }
}
