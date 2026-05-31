<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('group_id')->constrained()->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // O'quvchi (users jadvalidan)
            $table->date('date'); // Dars bo'lgan sana
            $table->enum('status', ['present', 'absent', 'excused'])->default('present'); // ✓, ✕, S
            $table->string('notes')->nullable(); // Sababi yoki qo'shimcha izoh
            $table->timestamps();

            // Bir o'quvchiga bitta guruhda ayni bir kunda faqat bitta davomat yozilishi sharti
            $table->unique(['group_id', 'student_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};