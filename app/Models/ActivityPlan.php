<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'objectives',
        'planned_date', 'location', 'budget', 'status',
        'approved_by', 'approved_at', 'rejection_reason'
    ];

    protected $casts = [
        'planned_date' => 'date',
        'approved_at' => 'datetime',
        'budget' => 'decimal:2',
    ];

    /**
     * Get the user who created this plan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category of this activity.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who approved this plan.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get realizations of this activity plan.
     */
    public function realizations()
    {
        return $this->hasMany(ActivityRealization::class);
    }
}
