<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $table = 'documentation_library';

    protected $fillable = [
        'user_id',
        'category_id',
        'activity_realization_id',
        'title',
        'description',
        'type',
        'file_path',
        'file_name',
        'file_type',
        'file_size',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function activityRealization()
    {
        return $this->belongsTo(ActivityRealization::class);
    }
}
