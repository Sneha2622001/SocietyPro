<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceBill extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'month', 'amount', 'due_date', 'status', 'paid_at', 'payment_method', 'receipt_number'];

    protected $casts = [
        'due_date' => 'date',
    ];
}
