<?php

namespace App\Livewire\Students;

use App\Models\User;
use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class StudentIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $branchId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::where('user_type', 'student')
            ->with(['branch', 'enrollments.batch']);

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

        return view('livewire.students.student-index', [
            'students' => $students,
            'branches' => $branches,
        ]);
    }
}
