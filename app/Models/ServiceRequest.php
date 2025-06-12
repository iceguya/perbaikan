<?php

// app/Models/ServiceRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'device_type',
        'brand',
        'model_number',
        'description',
        'status',
        'assigned_to_id',
    ];

    /**
     * Mendapatkan user yang membuat permintaan.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan teknisi yang ditugaskan (jika ada).
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}