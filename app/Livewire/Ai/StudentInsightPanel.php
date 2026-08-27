<?php

namespace App\Livewire\Ai;

use App\Models\User;
use App\Models\AiInsight;
use App\Services\AI\StudentRiskAnalyzer;
use Livewire\Component;

class StudentInsightPanel extends Component
{
    public ?int $selectedStudentId = null;
    public bool $isAnalyzing = false;

    public function mount(?int $studentId = null): void
    {
        if ($studentId) {
            $this->selectedStudentId = $studentId;
        } else {
            $firstStudent = User::where('user_type', 'student')->first();
            $this->selectedStudentId = $firstStudent?->id;
        }
    }

    public function runAnalysis(StudentRiskAnalyzer $analyzer): void
    {
        if (!$this->selectedStudentId) return;

        $this->isAnalyzing = true;
        $student = User::find($this->selectedStudentId);
        if ($student) {
            $analyzer->analyze($student);
        }
        $this->isAnalyzing = false;
    }

    public function render()
    {
        $students = User::where('user_type', 'student')->get();
        $selectedStudent = $this->selectedStudentId ? User::with('aiInsights')->find($this->selectedStudentId) : null;
        $latestInsight = $selectedStudent?->aiInsights()->latest()->first();

        return view('livewire.ai.student-insight-panel', [
            'students' => $students,
            'selectedStudent' => $selectedStudent,
            'latestInsight' => $latestInsight,
        ]);
    }
}
