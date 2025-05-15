<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Meeting;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MeetingRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $meetingCollision = true;
        while ($meetingCollision) {
            $userId = User::inRandomOrder()->first()->id;
            $bookMeetingId = Meeting::inRandomOrder()->first()->id;
            // 拿取隨機產生的的者的所有參與會議的時間，並轉成陣列
            $allMeetings = Meeting::leftjoin('meeting_records', 'meetings.id', '=', 'meeting_records.meeting_id')
                ->where('meetings.create_user_id', $userId)
                ->orwhere('meeting_records.user_id', $userId)
                ->pluck('start_at')
                ->toArray();
            $bookMeetingTime = Meeting::where('id', $bookMeetingId)->first()->start_at;

            if (!in_array($bookMeetingTime, $allMeetings)) {
                $meetingCollision = False;
            }
        }

        return [
            'meeting_id' => $bookMeetingId,
            'user_id' => $userId,
        ];
    }
}
