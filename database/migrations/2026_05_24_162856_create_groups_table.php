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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            
            // Tashqi kalitlar (Foreign Keys)
            // cascadeOnDelete() - o'quv markazi yoki kurs o'chib ketsa, unga tegishli guruhlar ham avtomat o'chadi
            $table->foreignId('learning_center_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();

            // Guruh ma'lumotlari
            $table->string('name'); // Masalan: F1-10, ENG-202
            $table->string('teacher_name');
            
            // Dars sozlamalari
            $table->enum('days_type', ['odd', 'even', 'custom'])->default('odd'); // toq, juft yoki boshqa kunlar
            $table->string('start_time'); // Masalan: 14:00, 18:30
            $table->string('room'); // Xona raqami yoki nomi
            
            // Limitlar va holat
            $table->integer('max_students')->default(15);
            $table->enum('status', ['collecting', 'active', 'finished'])->default('collecting');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};