<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityRealization extends Model
{
    protected $fillable = [
        'activity_plan_id', 'user_id', 'actual_date', 'actual_location',
        'participants_count', 'attendance_list', 'report', 'achievements',
        'obstacles', 'actual_budget', 'status', 'verified_by', 'verified_at'
    ];

    protected $casts = [
        'actual_date' => 'date',
        'verified_at' => 'datetime',
        'actual_budget' => 'decimal:2',
        'attendance_list' => 'array',
    ];

    public function activityPlan()
    {
        return $this->belongsTo(ActivityPlan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function documentation()
    {
        return $this->hasMany(Documentation::class);
    }
}
