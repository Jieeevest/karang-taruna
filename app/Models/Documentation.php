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
}
