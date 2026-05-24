<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // O'quv markaziga bog'lash (Foreign Key)
            // learning_centers jadvali o'chib ketsa, unga tegishli kurslar ham o'chib ketadi (onDelete cascade)
            $table->foreignId('learning_center_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title'); // Kurs nomi (M: Frontend Boot camp)
            $table->string('slug')->unique(); // URL uchun chiroyli nom (M: frontend-boot-camp)
            $table->text('description')->nullable(); // Kurs haqida batafsil ma'lumot

            // Moliyaviy ma'lumotlar
            $table->decimal('price', 12, 2)->default(0.00); // Oylik to'lov summasi

            // Kurs davomiyligi va formati
            $table->integer('duration_months')->default(1); // Necha oy davom etishi (M: 6)
            $table->integer('lessons_per_week')->default(3); // Haftada necha marta dars bo'lishi (M: 3)
            $table->integer('lesson_duration_minutes')->default(90); // Har bir dars necha daqiqa (M: 90)

            // Kurs holati va vizual qismi
            $table->string('icon')->nullable(); // Kurs uchun emoji yoki rasm yo'li (M: 🌐, 🎨)
            $table->boolean('is_active')->default(true); // Kurs faolmi yoki vaqtincha to'xtatilganmi

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};