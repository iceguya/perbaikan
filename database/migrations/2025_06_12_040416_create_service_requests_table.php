<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel users

            $table->string('device_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('model_number')->nullable();
            $table->text('description'); // Menggunakan text untuk deskripsi panjang

            // --- Opsional: Kolom tambahan jika Anda menginginkannya ---
            // $table->string('subject')->nullable();
            // $table->string('status')->default('pending'); // Status permintaan (pending, in_progress, completed, etc.)
            // $table->string('priority')->nullable();     // Priority (low, medium, high)
            // $table->timestamp('scheduled_at')->nullable(); // Tanggal/waktu jadwal perbaikan
            // --------------------------------------------------------

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};