<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_group', function (Blueprint $table) {
            $table->id();
            
            // O'quvchi va Guruh ID larini bog'laymiz
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            
            // O'quvchi guruhga qo'shilgan sana (statistika uchun asqotadi)
            $table->date('joined_at')->useCurrent(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_group');
    }
};