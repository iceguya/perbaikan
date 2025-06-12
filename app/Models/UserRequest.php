<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRequest extends Model
{
    use HasFactory;

    protected $table = 'user_requests'; // Nama tabel jika bukan 'requests'

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status', // Contoh: pending, in_progress, completed, rejected
        // Tambahkan kolom lain yang relevan
    ];

    /**
     * Get the user that owns the request.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}