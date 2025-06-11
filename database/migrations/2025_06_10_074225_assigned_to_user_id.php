<?php

// YYYY_MM_DD_HHMMSS_add_assigned_to_user_id_to_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('assigned_to_user_id')->nullable()->constrained('users')->onDelete('set null')->after('status');
            // Ganti 'status' dengan nama kolom setelah assigned_to_user_id akan diletakkan
            // nullable() karena mungkin awalnya belum ditugaskan
            // onDelete('set null') agar jika user teknisi dihapus, order tidak ikut terhapus
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['assigned_to_user_id']);
            $table->dropColumn('assigned_to_user_id');
        });
    }
};