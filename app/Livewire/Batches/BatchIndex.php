<?php

namespace App\Livewire\Batches;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BatchIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $branchId = '';
    public bool $showModal = false;

    // Form fields
    public string $name = '';
    public string $subject = '';
    public string $schedule = 'Mon, Wed, Fri 10:00 AM';
    public ?int $selectedBranchId = null;
    public ?int $selectedTeacherId = null;

    protected $rules = [
        'name'               => 'required|string|max:255',
        'subject'            => 'required|string|max:255',
        'schedule'           => 'required|string|max:255',
        'selectedBranchId'   => 'required|exists:branches,id',
        'selectedTeacherId'  => 'nullable|exists:users,id',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingBranchId(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->reset(['name', 'subject', 'schedule', 'selectedBranchId', 'selectedTeacherId']);
        $this->selectedBranchId = Branch::first()?->id;
        $this->showModal = true;
    }

    public function createBatch(): void
    {
        $this->validate();

        Batch::create([
            'branch_id'  => $this->selectedBranchId,
            'teacher_id' => $this->selectedTeacherId,
            'name'       => $this->name,
            'subject'    => $this->subject,
            'schedule'   => $this->schedule,
        ]);

        $this->showModal = false;
        session()->flash('success', 'Batch created successfully!');
    }

    public function render()
    {
        $batches = Batch::with(['branch', 'teacher', 'enrollments'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('subject', 'like', '%' . $this->search . '%');
            })
            ->when($this->branchId, function ($query) {
                $query->where('branch_id', $this->branchId);
            })
            ->latest()
            ->paginate(9);

        $branches = Branch::all();
        $teachers = User::where('user_type', 'teacher')->orWhere('user_type', 'super_admin')->get();

        return view('livewire.batches.batch-index', [
            'batches'  => $batches,
            'branches' => $branches,
            'teachers' => $teachers,
        ]);
    }
}
