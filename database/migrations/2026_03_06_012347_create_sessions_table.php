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
    Schema::create('skill_sessions', function (Blueprint $table) {
        $table->id();

        $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('student_id')->nullable()->constrained('users')->nullOnDelete();
        $table->foreignId('skill_id')->constrained()->cascadeOnDelete();

        $table->string('title');
        $table->text('description')->nullable();

        $table->date('session_date');
        $table->time('session_time');
        $table->integer('duration');

        $table->string('location')->nullable();

        $table->enum('status', ['pending','confirmed','completed','cancelled'])->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_sessions');
    }
};
