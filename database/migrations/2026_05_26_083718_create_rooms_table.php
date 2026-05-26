<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_center_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Masalan: "1-Xona (Green room)"
            $table->integer('capacity')->nullable(); // Xona sig'imi (ixtiyoriy)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};