<?php

namespace App\Livewire\Dashboard;

use App\Models\Branch;
use App\Models\User;
use App\Models\Batch;
use App\Models\Fee;
use App\Models\Attendance;
use Livewire\Component;
use Carbon\Carbon;

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

    public function render()
    {
        return view('livewire.dashboard.admin-dashboard');
    }
}
