<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'details',
        'status',
        'technician_id',
        // tambahkan kolom lain yang relevan di sini
    ];

    /**
     * Mendapatkan user (teknisi) yang ditugaskan untuk pesanan ini.
     */
    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}