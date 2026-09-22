<?php

namespace App\Livewire\Dashboard;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TeacherDashboard extends Component
{
    public array $todayBatches = [];
    public int $totalStudents = 0;
    public array $upcomingExams = [];
    public array $weeklyAttendance = [];
    public float $overallAttendanceRate = 0.0;

    public function mount(): void
    {
        $teacher = Auth::user();
        $today   = strtolower(Carbon::today()->format('D')); // mon, tue, wed…

        // My assigned batches (where teacher_id = me)
        $myBatches = Batch::with(['enrollments.student', 'branch'])
            ->where('teacher_id', $teacher->id)
            ->get();

        $this->totalStudents = $myBatches->sum(fn ($b) => $b->enrollments->count());

        // Batches teaching today (schedule_days contains today abbreviation, e.g. Sun,Tue,Thu)
        $this->todayBatches = $myBatches->filter(function ($batch) use ($today) {
            return str_contains(strtolower($batch->schedule_days ?? ''), substr($today, 0, 3));
        })->values()->map(fn ($b) => [
            'id'          => $b->id,
            'name'        => $b->name,
            'subject'     => $b->subject,
            'schedule'    => trim(($b->schedule_days ?? '') . ' ' . ($b->schedule_time ?? '')),
            'branch_name' => $b->branch?->name ?? '—',
            'students'    => $b->enrollments->count(),
        ])->toArray();

        // Upcoming exams for my batches (next 14 days)
        $batchIds = $myBatches->pluck('id');
        $this->upcomingExams = Exam::with('batch')
            ->whereIn('batch_id', $batchIds)
            ->whereBetween('exam_date', [Carbon::today(), Carbon::today()->addDays(14)])
            ->orderBy('exam_date')
            ->get()
            ->map(fn ($e) => [
                'title'     => $e->title,
                'batch'     => $e->batch?->name ?? '—',
                'exam_date' => $e->exam_date instanceof Carbon
                    ? $e->exam_date->format('d M, Y')
                    : Carbon::parse($e->exam_date)->format('d M, Y'),
                'days_left' => Carbon::today()->diffInDays(Carbon::parse($e->exam_date)),
            ])->toArray();

        // Last 7-day attendance rate across my batches
        $last7Days   = Carbon::today()->subDays(6)->toDateString();
        $todayStr    = Carbon::today()->toDateString();
        $totalMarked = Attendance::whereIn('batch_id', $batchIds)
            ->whereBetween('attendance_date', [$last7Days, $todayStr])
            ->count();
        $totalPresent = Attendance::whereIn('batch_id', $batchIds)
            ->whereBetween('attendance_date', [$last7Days, $todayStr])
            ->where('status', 'present')
            ->count();
        $this->overallAttendanceRate = $totalMarked > 0
            ? round(($totalPresent / $totalMarked) * 100, 1)
            : 0.0;

        // Per-day summary for sparkline
        $this->weeklyAttendance = collect(range(6, 0))->map(function ($daysAgo) use ($batchIds) {
            $date    = Carbon::today()->subDays($daysAgo)->toDateString();
            $total   = Attendance::whereIn('batch_id', $batchIds)->whereDate('attendance_date', $date)->count();
            $present = Attendance::whereIn('batch_id', $batchIds)->whereDate('attendance_date', $date)->where('status', 'present')->count();
            return [
                'label' => Carbon::parse($date)->format('D'),
                'rate'  => $total > 0 ? round(($present / $total) * 100) : 0,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.teacher-dashboard');
    }
}
