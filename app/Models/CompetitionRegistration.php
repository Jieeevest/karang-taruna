<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'school_class',
        'whatsapp',
        'domicile_rt',
        'competition_type',
        'payment_method',
    ];
}
