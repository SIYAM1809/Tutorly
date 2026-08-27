<?php

use App\Models\User;
use App\Services\AI\StudentRiskAnalyzer;

test('student risk analyzer returns fallback insight when gemini api is unconfigured', function () {
    $student = User::create([
        'name' => 'Test Student',
        'email' => 'test@student.com',
        'password' => bcrypt('password'),
        'user_type' => 'student',
    ]);

    $analyzer = new StudentRiskAnalyzer();
    $insight = $analyzer->analyze($student);

    expect($insight)->not->toBeNull();
    expect($insight->student_id)->toBe($student->id);
    expect($insight->risk_level)->toBeIn(['LOW', 'MEDIUM', 'HIGH']);
});
