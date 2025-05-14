<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\MeetingRecord;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingController extends Controller
{
    public function avaiableTime(Request $request)
    {
        $canBookTime = collect(CarbonPeriod::create('08:00', '1 hour', '19:00'))
            ->map(fn($time) => $time->format('H:i'))
            ->all();
        $alreadyBookTime = Meeting::whereDate('start_at', $request->date)
            ->pluck('start_at')
            ->map(fn($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();

        $response = array_values(array_diff($canBookTime, $alreadyBookTime));

        return response()->json($response);
    }

    public function avaiablePeople(Request $request)
    {
        $allUserId = User::get()->pluck('id')->toArray();
        $haveMeetingPeople = Meeting::leftjoin('meeting_records', 'meetings.id', '=', 'meeting_records.meeting_id')
            ->where('meetings.start_at', $request->date . ' ' . $request->time)
            ->pluck('meeting_records.user_id')
            ->toArray();
        $avaiablePeopleId = array_values(array_diff($allUserId, $haveMeetingPeople));

        $response = User::whereIn('id', $avaiablePeopleId)
            ->pluck('username')
            ->toarray();
        $response = array_values(array_diff($response, [$request->username]));
        return response()->json($response);
    }

    /**
     * Display a listing of the resourceblic function in//request)
     */
    public function index(Request $request)
    {
        // 避免把user表中多餘的資訊洩出
        $meetings = Meeting::with(['creator' => function ($query) {
            $query->select('id', 'username');
        }])->select('id', 'create_user_id', 'name', 'start_at')
            ->simplePaginate(15);
        $totalMeetings = Meeting::count();

        // dd($meetings);
        return view('meetroom', compact('meetings', 'totalMeetings'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            "meetingName" => ['required'],
            "date" => ['required'],
            "time" => ['required'],
            "attendee" => ['required'],
        ]);

        // 把資料寫進meetings表
        $dateTime = Carbon::parse(request("date") . ' ' . request("time"));
        $user = session('username');
        $creatorId = User::where('username', $user)
            ->value('id');
        $meeting = Meeting::create([
            'name' => request("meetingName"),
            'create_user_id' => $creatorId,
            'start_at' => $dateTime,
            'end_at' => $dateTime->copy()->addHour(1),
        ]);

        // 把資料寫進meeting_records表
        $userIds = User::whereIn('username', request('attendee'))
            ->pluck('id')
            ->toArray();
        $userIds[] = $creatorId;
        $meetingId = $meeting->id;
        $records = collect($userIds)->map(function ($userId) use ($meetingId) {
            return [
                'meeting_id' => $meetingId,
                'user_id' => $userId,
            ];
        })->toArray();
        MeetingRecord::insert($records);

        return redirect('/meetings');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 避免把user表中多餘的資訊洩出
        $meetingInfo =  Meeting::with(['creator' => function ($query) {
            $query->select('id', 'username');
        }])->where('id', $id)->first();
        return view('components.meet-edit', compact('meetingInfo'));
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
