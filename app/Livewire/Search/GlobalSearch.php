<?php

namespace App\Livewire\Search;

use App\Models\User;
use App\Models\Batch;
use Livewire\Component;

class GlobalSearch extends Component
{
    public string $query = '';
    public array $results = [];

    public function updatedQuery(): void
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        $students = User::where('user_type', 'student')
            ->where(function($q) {
                $q->where('name', 'like', "%{$this->query}%")
                  ->orWhere('email', 'like', "%{$this->query}%")
                  ->orWhere('phone', 'like', "%{$this->query}%");
            })->take(5)->get(['id', 'name', 'email']);

        $batches = Batch::where('name', 'like', "%{$this->query}%")
            ->orWhere('subject', 'like', "%{$this->query}%")
            ->take(5)->get(['id', 'name', 'subject']);

        $this->results = [
            'students' => $students,
            'batches' => $batches,
        ];
    }

    public function render()
    {
        return view('livewire.search.global-search');
    }
}
