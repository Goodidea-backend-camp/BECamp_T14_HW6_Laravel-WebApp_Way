<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\MeetingRecord;
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
        // 如果沒使用clone modify會去修改原本的數值，導致startDay跟endDay相等
        $endDay = (clone $startDay)->modify('+1 hours');

        return [
            'create_user_id' => User::inRandomOrder()->first()->id,
            'name' => fake()->catchPhrase(),
            'start_at' => $startDay,
            'end_at' => $endDay,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Meeting $meeting) {
            MeetingRecord::create([
                'meeting_id' => $meeting->id,
                'user_id' => $meeting->create_user_id,
            ]);
        });
    }
}
