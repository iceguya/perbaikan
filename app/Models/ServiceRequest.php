<?php
// File: app/Models/ServiceRequest.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'device_type', 'brand', 'series_model', 'description', 'status',
    ];

    // Opsional: Definisikan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}