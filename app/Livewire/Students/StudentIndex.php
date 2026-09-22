<?php

namespace App\Livewire\Students;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class StudentIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $branchId = null;

    // Student Profile Slide-over
    public ?User $profileStudent = null;
    public bool $showProfileModal = false;

    // Enroll New Student Modal
    public bool $showCreateModal = false;
    public string $newName = '';
    public string $newEmail = '';
    public string $newPhone = '';
    public string $newGuardianPhone = '';
    public ?int $newBranchId = null;
    public ?int $newBatchId = null;

    protected $rules = [
        'newName'          => 'required|string|max:255',
        'newEmail'         => 'required|email|unique:users,email',
        'newPhone'         => 'required|string|max:20',
        'newGuardianPhone' => 'nullable|string|max:20',
        'newBranchId'      => 'required|exists:branches,id',
        'newBatchId'       => 'nullable|exists:batches,id',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingBranchId(): void
    {
        $this->resetPage();
    }

    public function viewStudentProfile(int $id): void
    {
        $this->profileStudent = User::with([
            'branch',
            'enrollments.batch',
            'attendances' => fn($q) => $q->latest()->take(10),
            'fees'        => fn($q) => $q->latest()->take(5),
            'aiInsights'  => fn($q) => $q->latest()->take(3),
        ])->find($id);

        $this->showProfileModal = true;
    }

    public function closeProfile(): void
    {
        $this->showProfileModal = false;
        $this->profileStudent = null;
    }

    public function openCreateModal(): void
    {
        $this->reset(['newName', 'newEmail', 'newPhone', 'newGuardianPhone']);
        $this->newBranchId = Branch::first()?->id;
        $this->newBatchId = Batch::first()?->id;
        $this->showCreateModal = true;
    }

    public function enrollStudent(): void
    {
        $this->validate();

        $student = User::create([
            'name'           => $this->newName,
            'email'          => $this->newEmail,
            'phone'          => $this->newPhone,
            'guardian_phone' => $this->newGuardianPhone,
            'branch_id'      => $this->newBranchId,
            'user_type'      => 'student',
            'password'       => Hash::make('password'),
        ]);

        $student->assignRole('student');

        if ($this->newBatchId) {
            Enrollment::create([
                'student_id' => $student->id,
                'batch_id'   => $this->newBatchId,
                'status'     => 'active',
            ]);
        }

        $this->showCreateModal = false;
        session()->flash('success', "Student {$student->name} enrolled successfully! Default password is 'password'.");
    }

    public function render()
    {
        $query = User::where('user_type', 'student')
            ->with(['branch', 'enrollments.batch', 'attendances', 'fees']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%");
            });
        }

        if ($this->branchId) {
            $query->where('branch_id', $this->branchId);
        }

        $students = $query->paginate(10);
        $branches = Branch::all();
        $batches = Batch::all();

        return view('livewire.students.student-index', [
            'students' => $students,
            'branches' => $branches,
            'batches'  => $batches,
        ]);
    }
}

