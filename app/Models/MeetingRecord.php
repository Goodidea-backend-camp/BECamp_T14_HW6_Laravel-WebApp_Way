<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingRecord extends Model
{   
    use HasFactory;
    
    public $timestamps = false;

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
