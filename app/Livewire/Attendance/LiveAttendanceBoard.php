<?php

namespace App\Livewire\Attendance;

use App\Models\Batch;
use App\Models\Attendance;
use App\Events\AttendanceMarked;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LiveAttendanceBoard extends Component
{
    public ?int $selectedBatchId = null;
    public string $attendanceDate;
    public array $attendanceStates = [];

    public function mount(): void
    {
        $this->attendanceDate = Carbon::today()->toDateString();
        $batch = Batch::first();
        if ($batch) {
            $this->selectedBatchId = $batch->id;
            $this->loadBatchStudents();
        }
    }

    public function updatedSelectedBatchId(): void
    {
        $this->loadBatchStudents();
    }

    public function loadBatchStudents(): void
    {
        if (!$this->selectedBatchId) return;

        $batch = Batch::with('enrollments.student')->find($this->selectedBatchId);
        if (!$batch) return;

        $existingAttendances = Attendance::where('batch_id', $this->selectedBatchId)
            ->where('attendance_date', $this->attendanceDate)
            ->pluck('status', 'student_id')
            ->toArray();

        $this->attendanceStates = [];
        foreach ($batch->enrollments as $enrollment) {
            $studentId = $enrollment->student_id;
            $this->attendanceStates[$studentId] = $existingAttendances[$studentId] ?? 'present';
        }
    }

    public function toggleStatus(int $studentId, string $status): void
    {
        $this->attendanceStates[$studentId] = $status;

        $attendance = Attendance::updateOrCreate(
            [
                'batch_id' => $this->selectedBatchId,
                'student_id' => $studentId,
                'attendance_date' => $this->attendanceDate,
            ],
            [
                'branch_id' => Auth::user()->branch_id ?? 1,
                'marked_by_id' => Auth::id(),
                'status' => $status,
            ]
        );

        // Dispatch WebSocket event via Laravel Reverb
        AttendanceMarked::dispatch($attendance);
    }

    public function render()
    {
        $batches = Batch::all();
        $currentBatch = $this->selectedBatchId ? Batch::with('enrollments.student')->find($this->selectedBatchId) : null;

        return view('livewire.attendance.live-attendance-board', [
            'batches' => $batches,
            'currentBatch' => $currentBatch,
        ]);
    }
}
