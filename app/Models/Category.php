<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'description'];

    /**
     * Get activity plans in this category.
     */
    public function activityPlans()
    {
        return $this->hasMany(ActivityPlan::class);
    }

    /**
     * Get contents in this category.
     */
    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    /**
     * Get documentation in this category.
     */
    public function documentation()
    {
        return $this->hasMany(Documentation::class);
    }
}
