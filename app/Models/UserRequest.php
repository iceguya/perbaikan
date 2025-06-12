<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import ini

class UserRequest extends Model
{
    use HasFactory;

    protected $table = 'service_requests'; // Pastikan ini sesuai

    protected $fillable = [
        'user_id',
        'device_type',
        'brand',
        'model_number',
        'description',
        'status',
        'assigned_to_user_id', // <<< TAMBAHKAN INI
    ];

    /**
     * Get the user that made the request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the technician assigned to the request.
     */
    public function assignedToUser(): BelongsTo // <<< TAMBAHKAN RELASI INI
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}