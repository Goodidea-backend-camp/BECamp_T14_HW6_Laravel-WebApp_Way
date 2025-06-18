<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'create_user_id',
        'start_at',
        'end_at',
    ];

    public function meeting_records()
    {
        return $this->hasMany(MeetingRecord::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'create_user_id');
    }
}
