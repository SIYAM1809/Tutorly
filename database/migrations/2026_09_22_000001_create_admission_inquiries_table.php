<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->string('student_name');
            $table->string('student_phone');
            $table->string('guardian_phone')->nullable();
            $table->string('batch_name')->nullable();
            $table->string('campus_name')->nullable();
            $table->string('status')->default('pending'); // 'pending', 'contacted', 'enrolled', 'rejected'
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_inquiries');
    }
};
