<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_center_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('title'); // Lavozimi: Masalan, "Senior Mentor", "Bosh Administrator"
            $table->string('specialty')->nullable(); // Sohasi: Masalan, "IT & Dasturlash", "Sotuv"
            $table->enum('role', ['admin', 'teacher', 'reception'])->default('teacher'); // Tizimdagi roli
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};