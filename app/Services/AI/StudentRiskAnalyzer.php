<?php

namespace App\Services\AI;

use App\Models\User;
use App\Models\AiInsight;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StudentRiskAnalyzer
{
    /**
     * Analyze a student's risk profile using Gemini API, with graceful offline fallback.
     */
    public function analyze(User $student): AiInsight
    {
        // 1. Gather context
        $totalClasses = $student->attendances()->count();
        $presentClasses = $student->attendances()->where('status', 'present')->count();
        $attendanceRate = $totalClasses > 0 ? round(($presentClasses / $totalClasses) * 100, 1) : 100.0;

        $unpaidFees = $student->fees()->where('status', 'unpaid')->count();
        $totalUnpaidAmount = $student->fees()->where('status', 'unpaid')->sum('amount');

        $promptContext = [
            'student_name' => $student->name,
            'attendance_rate_percent' => $attendanceRate,
            'unpaid_fees_count' => $unpaidFees,
            'total_unpaid_amount' => $totalUnpaidAmount,
        ];

        $apiKey = config('services.gemini.api_key');
        $model = config('services.gemini.model', 'gemini-2.5-flash');

        $aiSummary = null;
        $riskLevel = 'LOW';

        if ($apiKey && $apiKey !== 'your_gemini_api_key_here') {
            try {
                $response = Http::timeout(10)->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}", [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => "Analyze the following student data and provide a concise risk assessment in 2 sentences.\n" .
                                              "Data: Attendance: {$attendanceRate}%, Unpaid Fees Count: {$unpaidFees}, Total Unpaid: {$totalUnpaidAmount} BDT.\n" .
                                              "Format response as JSON with keys: risk_level (HIGH/MEDIUM/LOW), summary, recommendation."
                                ]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $json = $response->json();
                    $text = $json['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    $aiSummary = $text;

                    if (str_contains(strtoupper($text), 'HIGH')) {
                        $riskLevel = 'HIGH';
                    } elseif (str_contains(strtoupper($text), 'MEDIUM')) {
                        $riskLevel = 'MEDIUM';
                    }
                }
            } catch (\Exception $e) {
                Log::warning("Gemini API call failed for student ID {$student->id}: " . $e->getMessage());
            }
        }

        // Rule-based Fallback if AI call failed or key absent
        if (!$aiSummary) {
            if ($attendanceRate < 70 || $unpaidFees >= 2) {
                $riskLevel = 'HIGH';
                $aiSummary = "Student's attendance has dropped to {$attendanceRate}% with {$unpaidFees} unpaid fee invoice(s). Immediate guardian contact recommended.";
            } elseif ($attendanceRate < 85 || $unpaidFees === 1) {
                $riskLevel = 'MEDIUM';
                $aiSummary = "Student's attendance is moderate ({$attendanceRate}%). 1 fee payment is pending.";
            } else {
                $riskLevel = 'LOW';
                $aiSummary = "Student is performing well with {$attendanceRate}% attendance and clear fee record.";
            }
        }

        return AiInsight::create([
            'student_id' => $student->id,
            'insight_type' => 'risk_assessment',
            'risk_level' => $riskLevel,
            'summary_text' => $aiSummary,
            'recommended_action' => $riskLevel === 'HIGH' ? 'Contact parent via WhatsApp / Call' : 'Monitor weekly',
            'raw_prompt_context' => $promptContext,
            'generated_at' => Carbon::now(),
        ]);
    }
}
