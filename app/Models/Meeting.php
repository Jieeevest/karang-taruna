<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'meeting_date',
        'meeting_time',
        'location',
        'agenda',
        'notes',
        'status'
    ];

    protected $casts = [
        'meeting_date' => 'date',
        'meeting_time' => 'datetime:H:i',
    ];

    /**
     * Get the user who created this meeting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
