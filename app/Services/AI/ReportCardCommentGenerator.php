<?php

namespace App\Services\AI;

use App\Models\User;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReportCardCommentGenerator
{
    public function generateDraft(User $student, Exam $exam, float $marksObtained): string
    {
        $percentage = ($marksObtained / $exam->total_marks) * 100;
        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        if ($apiKey && $apiKey !== 'your_gemini_api_key_here') {
            try {
                $response = Http::timeout(8)->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "Write a encouraging 1-sentence teacher remark for report card. Student: {$student->name}, Exam: {$exam->title}, Score: {$marksObtained}/{$exam->total_marks} ({$percentage}%)."
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
                Log::warning("Gemini API error in report card comment: " . $e->getMessage());
            }
        }

        // Rule-based fallback
        if ($percentage >= 80) {
            return "{$student->name} demonstrated outstanding comprehension and excellence in {$exam->title}.";
        } elseif ($percentage >= 60) {
            return "{$student->name} showed good progress in {$exam->title} with consistent effort.";
        } else {
            return "{$student->name} needs extra practice in fundamental concepts covered in {$exam->title}.";
        }
    }
}
