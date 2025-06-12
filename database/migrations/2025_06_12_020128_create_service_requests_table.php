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
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user yang membuat request
        $table->string('device_type'); // e.g., 'Laptop', 'Smartphone', 'TV'
        $table->string('brand')->nullable();
        $table->string('model_number')->nullable();
        $table->text('description');
        $table->string('status')->default('submitted'); // e.g., submitted, in_progress, completed, cancelled
        $table->foreignId('assigned_to_id')->nullable()->constrained('users')->onDelete('set null'); // Relasi ke teknisi
        $table->timestamps();
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
