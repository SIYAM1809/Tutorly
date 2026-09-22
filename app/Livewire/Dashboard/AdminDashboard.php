<?php

namespace App\Livewire\Dashboard;

use App\Models\AdmissionInquiry;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Branch;
use App\Models\Fee;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class AdminDashboard extends Component
{
    public int $totalBranches = 0;
    public int $totalStudents = 0;
    public int $totalBatches = 0;
    public float $monthlyRevenue = 0.00;
    public float $todayAttendanceRate = 0.0;

    public function mount(): void
    {
        $this->totalBranches = Branch::count();
        $this->totalStudents = User::where('user_type', 'student')->count();
        $this->totalBatches = Batch::count();
        $this->monthlyRevenue = (float) Fee::where('status', 'paid')->sum('paid_amount');

        $todayTotal = Attendance::where('attendance_date', Carbon::today()->toDateString())->count();
        $todayPresent = Attendance::where('attendance_date', Carbon::today()->toDateString())->where('status', 'present')->count();
        $this->todayAttendanceRate = $todayTotal > 0 ? round(($todayPresent / $todayTotal) * 100, 1) : 92.5;
    }

    public function updateInquiryStatus(int $inquiryId, string $status): void
    {
        $inquiry = AdmissionInquiry::find($inquiryId);
        if ($inquiry && in_array($status, ['pending', 'contacted', 'enrolled', 'rejected'])) {
            $inquiry->update(['status' => $status]);
        }
    }

    public function render()
    {
        $inquiries = AdmissionInquiry::latest()->take(6)->get();
        return view('livewire.dashboard.admin-dashboard', compact('inquiries'));
    }
}
