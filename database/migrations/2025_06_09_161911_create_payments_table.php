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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel orders
            $table->string('payment_method');
            $table->decimal('amount', 10, 2); // Penting: tipe data decimal untuk jumlah uang
            $table->string('status')->default('pending'); // Contoh: 'pending', 'completed', 'failed', 'refunded'
            $table->string('transaction_id')->nullable(); // ID transaksi dari payment gateway (jika ada)
            $table->timestamp('payment_date')->nullable(); // Penting: tipe data timestamp untuk tanggal
            $table->text('notes')->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};