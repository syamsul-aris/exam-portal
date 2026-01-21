<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exam_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('score')->nullable();
            $table->integer('max_score')->nullable();

            $table->boolean('is_submitted')->default(false);
            $table->timestamp('submitted_at')->nullable();

            $table->timestamps();

            $table->unique(['exam_id', 'student_id']); // student attempt sekali je
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};
