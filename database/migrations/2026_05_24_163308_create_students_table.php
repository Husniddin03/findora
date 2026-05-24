<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            
            // Qaysi o'quv markazining o'quvchisi ekanligi
            $table->foreignId('learning_center_id')->constrained()->cascadeOnDelete();
            
            // Shaxsiy ma'lumotlar
            $table->string('name');
            $table->string('phone_number');
            $table->string('parent_phone_number')->nullable(); // Ota-onasining raqami (ixtiyoriy)
            $table->date('birth_date')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            
            // Balans va holat
            $table->decimal('balance', 12, 2)->default(0.00); // O'quvchining hisobi (to'lovlar uchun)
            $table->enum('status', ['active', 'frozen', 'left'])->default('active'); // faol, muzlatilgan, chiqib ketgan

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};