<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_exam', function (Blueprint $table) {
            $table->id();

            $table->foreignId('class_room_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('exam_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['class_room_id', 'exam_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_exam');
    }
};
