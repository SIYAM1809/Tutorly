<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\Exam;
use App\Models\Fee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentDashboard extends Component
{
    public array  $enrolledBatches     = [];
    public float  $attendanceRate      = 0.0;
    public int    $presentCount        = 0;
    public int    $totalClassDays      = 0;
    public array  $upcomingExams       = [];
    public array  $pendingFees         = [];
    public float  $totalDue            = 0.0;
    public array  $certificates        = [];
    public array  $recentResults       = [];

    public function mount(): void
    {
        $student = Auth::user();

        // ── Enrolled Batches ────────────────────────────────────────────────
        $enrollments = Enrollment::with(['batch.branch', 'batch.teacher'])
            ->where('student_id', $student->id)
            ->where('status', 'active')
            ->get();

        $this->enrolledBatches = $enrollments->map(fn ($e) => [
            'batch_id'    => $e->batch_id,
            'name'        => $e->batch?->name ?? '—',
            'subject'     => $e->batch?->subject ?? '—',
            'schedule'    => trim(($e->batch?->schedule_days ?? '') . ' ' . ($e->batch?->schedule_time ?? '')),
            'branch'      => $e->batch?->branch?->name ?? '—',
            'teacher'     => $e->batch?->teacher?->name ?? 'Not assigned',
        ])->toArray();

        $batchIds = $enrollments->pluck('batch_id');

        // ── Attendance This Month ───────────────────────────────────────────
        $monthStart = Carbon::now()->startOfMonth()->toDateString();
        $today      = Carbon::today()->toDateString();

        $this->totalClassDays = Attendance::where('student_id', $student->id)
            ->whereBetween('attendance_date', [$monthStart, $today])
            ->count();

        $this->presentCount = Attendance::where('student_id', $student->id)
            ->whereBetween('attendance_date', [$monthStart, $today])
            ->where('status', 'present')
            ->count();

        $this->attendanceRate = $this->totalClassDays > 0
            ? round(($this->presentCount / $this->totalClassDays) * 100, 1)
            : 0.0;

        // ── Upcoming Exams (next 30 days, for my batches) ───────────────────
        $this->upcomingExams = Exam::with('batch')
            ->whereIn('batch_id', $batchIds)
            ->where('exam_date', '>=', $today)
            ->orderBy('exam_date')
            ->take(5)
            ->get()
            ->map(fn ($e) => [
                'title'     => $e->title,
                'batch'     => $e->batch?->name ?? '—',
                'exam_date' => Carbon::parse($e->exam_date)->format('d M, Y'),
                'days_left' => Carbon::today()->diffInDays(Carbon::parse($e->exam_date)),
            ])->toArray();

        // ── Pending Fees ────────────────────────────────────────────────────
        $fees = Fee::where('student_id', $student->id)
            ->whereIn('status', ['pending', 'overdue'])
            ->orderBy('due_date')
            ->get();

        $this->pendingFees = $fees->map(fn ($f) => [
            'id'       => $f->id,
            'title'    => $f->title,
            'amount'   => $f->amount,
            'due_date' => Carbon::parse($f->due_date)->format('d M, Y'),
            'overdue'  => Carbon::parse($f->due_date)->isPast(),
        ])->toArray();

        $this->totalDue = $fees->sum('amount');

        // ── Certificates ────────────────────────────────────────────────────────
        $this->certificates = \App\Models\Certificate::with('batch')
            ->where('student_id', $student->id)
            ->orderByDesc('issued_at')
            ->get()
            ->map(fn ($c) => [
                'number'    => $c->certificate_number,
                'batch'     => $c->batch?->name ?? '—',
                'issued_at' => ($c->issued_at instanceof \Carbon\Carbon
                    ? $c->issued_at
                    : \Carbon\Carbon::parse($c->issued_at))->format('d M, Y'),
            ])->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.student-dashboard');
    }
}
