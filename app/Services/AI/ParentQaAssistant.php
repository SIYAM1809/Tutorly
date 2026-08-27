<?php

namespace App\Services\AI;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ParentQaAssistant
{
    public function answerQuery(User $student, string $question): string
    {
        $totalClasses = $student->attendances()->count();
        $presentClasses = $student->attendances()->where('status', 'present')->count();
        $attendanceRate = $totalClasses > 0 ? round(($presentClasses / $totalClasses) * 100, 1) : 100.0;
        $unpaidFees = $student->fees()->where('status', 'unpaid')->count();

        $context = "Student Name: {$student->name}\nAttendance: {$attendanceRate}%\nUnpaid Fee Invoices: {$unpaidFees}\n";

        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        if ($apiKey && $apiKey !== 'your_gemini_api_key_here') {
            try {
                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "You are an assistant for Tutorly coaching center. Answer the parent's question based strictly on this student context:\n{$context}\nParent Question: {$question}"
                                ]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    return trim($json['candidates'][0]['content']['parts'][0]['text'] ?? '');
                }
            } catch (\Exception $e) {
                Log::warning("Gemini parent QA error: " . $e->getMessage());
            }
        }

        // Fallback
        return "Based on records, {$student->name} currently has an attendance rate of {$attendanceRate}% and {$unpaidFees} pending fee invoice(s). Please contact the branch office for further details.";
    }
}
