<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_insights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->cascadeOnDelete();
            $table->enum('insight_type', ['risk_assessment', 'report_card_remark', 'parent_qa'])->default('risk_assessment');
            $table->string('risk_level')->default('LOW'); // HIGH, MEDIUM, LOW
            $table->text('summary_text');
            $table->text('recommended_action')->nullable();
            $table->json('raw_prompt_context')->nullable();
            $table->timestamp('generated_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_insights');
    }
};
