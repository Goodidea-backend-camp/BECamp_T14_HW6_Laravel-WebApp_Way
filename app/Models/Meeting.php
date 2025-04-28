<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meeting extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    public function meeting_records()
    {
        return $this->hasMany(MeetingRecord::class);
    }
    
}
