<?php

namespace App\Livewire\Fees;

use App\Models\Batch;
use App\Models\Branch;
use App\Models\Fee;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class FeeIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public string $branchId = '';
    public bool $showModal = false;

    // Create Fee Invoice Fields
    public ?int $selectedStudentId = null;
    public ?int $selectedBatchId = null;
    public ?int $selectedBranchId = null;
    public string $title = 'Monthly Tuition Fee - ' . 'August 2026';
    public float $amount = 3500.00;
    public string $dueDate = '';

    protected $rules = [
        'selectedStudentId' => 'required|exists:users,id',
        'selectedBatchId'   => 'nullable|exists:batches,id',
        'selectedBranchId'  => 'required|exists:branches,id',
        'title'             => 'required|string|max:255',
        'amount'            => 'required|numeric|min:1',
        'dueDate'           => 'required|date',
    ];

    public function mount(): void
    {
        $this->dueDate = Carbon::today()->addDays(10)->toDateString();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatus(): void
    {
        $this->resetPage();
    }

    public function updatingBranchId(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->selectedBranchId = Branch::first()?->id;
        $this->selectedStudentId = User::where('user_type', 'student')->first()?->id;
        $this->selectedBatchId = Batch::first()?->id;
        $this->showModal = true;
    }

    public function createFee(): void
    {
        $this->validate();

        Fee::create([
            'branch_id'   => $this->selectedBranchId,
            'student_id'  => $this->selectedStudentId,
            'batch_id'    => $this->selectedBatchId,
            'title'       => $this->title,
            'amount'      => $this->amount,
            'due_date'    => $this->dueDate,
            'status'      => 'pending',
            'paid_amount' => 0.00,
        ]);

        $this->showModal = false;
        session()->flash('success', 'Fee invoice generated successfully!');
    }

    public function markAsPaid(int $feeId): void
    {
        $fee = Fee::find($feeId);
        if ($fee) {
            $fee->update([
                'status'      => 'paid',
                'paid_amount' => $fee->amount,
            ]);
            session()->flash('success', "Invoice #{$fee->id} marked as Paid.");
        }
    }

    public function render()
    {
        $fees = Fee::with(['student', 'batch', 'branch', 'payments'])
            ->when($this->search, function ($query) {
                $query->whereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                })->orWhere('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->branchId, function ($query) {
                $query->where('branch_id', $this->branchId);
            })
            ->latest()
            ->paginate(10);

        $branches = Branch::all();
        $students = User::where('user_type', 'student')->get();
        $batches = Batch::all();

        return view('livewire.fees.fee-index', [
            'fees'     => $fees,
            'branches' => $branches,
            'students' => $students,
            'batches'  => $batches,
        ]);
    }
}
