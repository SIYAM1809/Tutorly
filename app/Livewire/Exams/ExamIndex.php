<?php

namespace App\Livewire\Exams;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Certificate;
use App\Models\Exam;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ExamIndex extends Component
{
    use WithPagination;

    public string $tab = 'exams'; // 'exams' or 'certificates'
    public string $search = '';
    public bool $showExamModal = false;
    public bool $showCertModal = false;

    // Exam Form
    public string $examTitle = '';
    public ?int $selectedBatchId = null;
    public ?int $selectedBranchId = null;
    public float $totalMarks = 100.00;
    public float $passMarks = 40.00;
    public string $examDate = '';

    // Certificate Form
    public ?int $certStudentId = null;
    public ?int $certBatchId = null;

    protected $rules = [
        'examTitle'        => 'required|string|max:255',
        'selectedBatchId'  => 'required|exists:batches,id',
        'selectedBranchId' => 'required|exists:branches,id',
        'totalMarks'       => 'required|numeric|min:1',
        'passMarks'        => 'required|numeric|min:1',
        'examDate'         => 'required|date',
    ];

    public function mount(): void
    {
        $this->examDate = Carbon::today()->addDays(7)->toDateString();
    }

    public function openExamModal(): void
    {
        $this->selectedBranchId = Branch::first()?->id;
        $this->selectedBatchId = Batch::first()?->id;
        $this->showExamModal = true;
    }

    public function createExam(): void
    {
        $this->validate();

        Exam::create([
            'branch_id'   => $this->selectedBranchId,
            'batch_id'    => $this->selectedBatchId,
            'title'       => $this->examTitle,
            'total_marks' => $this->totalMarks,
            'pass_marks'  => $this->passMarks,
            'exam_date'   => $this->examDate,
        ]);

        $this->showExamModal = false;
        $this->reset(['examTitle']);
        session()->flash('success', 'Exam scheduled successfully!');
    }

    public function openCertModal(): void
    {
        $this->certStudentId = User::where('user_type', 'student')->first()?->id;
        $this->certBatchId = Batch::first()?->id;
        $this->showCertModal = true;
    }

    public function issueCertificate(): void
    {
        $this->validate([
            'certStudentId' => 'required|exists:users,id',
            'certBatchId'   => 'required|exists:batches,id',
        ]);

        $certNum = 'TL-CERT-' . strtoupper(Str::random(8));
        $hash = hash('sha256', $certNum . time());

        Certificate::create([
            'student_id'         => $this->certStudentId,
            'batch_id'           => $this->certBatchId,
            'certificate_number' => $certNum,
            'verification_hash'  => $hash,
            'issued_at'          => Carbon::today(),
        ]);

        $this->showCertModal = false;
        session()->flash('success', "Certificate {$certNum} issued successfully!");
    }

    public function render()
    {
        $exams = Exam::with(['batch.branch'])
            ->when($this->search, function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(8, ['*'], 'exams_page');

        $certificates = Certificate::with(['student', 'batch.branch'])
            ->when($this->search, function ($q) {
                $q->where('certificate_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('student', fn($sq) => $sq->where('name', 'like', '%' . $this->search . '%'));
            })
            ->latest()
            ->paginate(8, ['*'], 'certs_page');

        $branches = Branch::all();
        $batches = Batch::all();
        $students = User::where('user_type', 'student')->get();

        return view('livewire.exams.exam-index', [
            'exams'        => $exams,
            'certificates' => $certificates,
            'branches'     => $branches,
            'batches'      => $batches,
            'students'     => $students,
        ]);
    }
}
