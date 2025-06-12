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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('description'); // Deskripsi pesanan
            $table->string('status')->default('pending'); // Status pesanan: pending, assigned, in_progress, completed, canceled, rejected

            // Kolom untuk penugasan ke teknisi
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('set null');

            // Kolom untuk informasi pelanggan (jika belum ada di tabel user yang merequest)
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_phone')->nullable(); // Opsional: nomor telepon pelanggan

            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};