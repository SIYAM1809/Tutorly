<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name'); // e.g., HSC Math Batch 2026-A
            $table->string('subject');
            $table->decimal('monthly_fee', 10, 2);
            $table->integer('capacity')->default(40);
            $table->string('schedule_days')->nullable(); // e.g., Sun,Tue,Thu
            $table->string('schedule_time')->nullable(); // e.g., 10:00 AM - 11:30 AM
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
