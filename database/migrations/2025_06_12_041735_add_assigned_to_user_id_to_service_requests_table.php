<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            // Tambahkan kolom foreignId setelah user_id
            $table->foreignId('assigned_to_user_id')
                  ->nullable() // Bisa null jika belum ditugaskan
                  ->constrained('users') // Merujuk ke tabel users
                  ->onDelete('set null') // Jika user teknisi dihapus, kolom ini jadi null
                  ->after('status'); // Posisikan setelah kolom 'status'
        });
    }

    public function down(): void
    {
        Schema::table('service_requests', function (Blueprint $table) {
            $table->dropForeign(['assigned_to_user_id']);
            $table->dropColumn('assigned_to_user_id');
        });
    }
};