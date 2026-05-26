<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedule_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('schedule_id')->nullable()->constrained()->onDelete('set null'); // Seriyaga bog'liqlik
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->date('date'); // Aniq dars kuni sanasi
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            // Bir xonada ayni bir vaqtda bitta dars bo'lishi qoidasi (ixtiyoriy kontrol uchun indeks)
            $table->unique(['room_id', 'date', 'start_time'], 'room_session_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedule_sessions');
    }
};