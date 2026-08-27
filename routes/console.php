<?php

use Illuminate\Support\Facades\Schedule;
use App\Models\User;
use App\Services\AI\StudentRiskAnalyzer;

// Weekly scheduled job for AI Student Risk Analysis
Schedule::call(function () {
    $analyzer = app(StudentRiskAnalyzer::class);
    User::where('user_type', 'student')->chunk(50, function ($students) use ($analyzer) {
        foreach ($students as $student) {
            $analyzer->analyze($student);
        }
    });
})->weeklyOn(1, '08:00');
