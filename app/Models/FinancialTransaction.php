<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_date',
        'type',
        'category',
        'amount',
        'description',
        'notes',
        'evidence_file'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the user who created this transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
