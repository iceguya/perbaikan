<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method',
        'amount',
        'status', // Contoh: 'pending', 'processing', 'completed', 'failed', 'refunded'
        'transaction_id', // ID transaksi dari payment gateway (jika ada)
        'payment_date',
        'notes',
    ];

    protected $dates = ['payment_date'];

    /**
     * Get the order that owns the payment.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}