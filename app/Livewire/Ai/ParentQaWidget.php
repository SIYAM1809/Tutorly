<?php

namespace App\Livewire\Ai;

use App\Models\User;
use App\Services\AI\ParentQaAssistant;
use Livewire\Component;

class ParentQaWidget extends Component
{
    public ?int $selectedStudentId = null;
    public string $question = '';
    public array $chatHistory = [];

    public function mount(): void
    {
        $firstStudent = User::where('user_type', 'student')->first();
        $this->selectedStudentId = $firstStudent?->id;
    }

    public function ask(ParentQaAssistant $assistant): void
    {
        if (trim($this->question) === '' || !$this->selectedStudentId) {
            return;
        }

        $student = User::find($this->selectedStudentId);
        if (!$student) return;

        $userMsg = $this->question;
        $this->chatHistory[] = ['sender' => 'user', 'text' => $userMsg];
        $this->question = '';

        $answer = $assistant->answerQuery($student, $userMsg);
        $this->chatHistory[] = ['sender' => 'assistant', 'text' => $answer];
    }

    public function render()
    {
        $students = User::where('user_type', 'student')->get();
        return view('livewire.ai.parent-qa-widget', [
            'students' => $students,
        ]);
    }
}
