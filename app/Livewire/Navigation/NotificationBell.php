<?php

namespace App\Livewire\Navigation;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationBell extends Component
{
    public array $notifications = [];
    public int $unreadCount = 0;

    public function mount(): void
    {
        $this->notifications = [
            ['title' => 'Fee Reminder Sent', 'message' => 'WhatsApp fee reminders dispatched to HSC Batch A parents.', 'time' => '10m ago'],
            ['title' => 'Attendance Flag', 'message' => 'Attendance board updated for Dhaka Main Branch.', 'time' => '25m ago'],
        ];
        $this->unreadCount = count($this->notifications);
    }

    public function getListeners(): array
    {
        $userId = Auth::id();
        return [
            "echo-private:user.{$userId},NotificationSent" => 'handleNotification',
        ];
    }

    public function handleNotification($event): void
    {
        array_unshift($this->notifications, [
            'title' => $event['title'] ?? 'New Alert',
            'message' => $event['message'] ?? '',
            'time' => 'Just now',
        ]);
        $this->unreadCount++;
    }

    public function markAsRead(): void
    {
        $this->unreadCount = 0;
    }

    public function render()
    {
        return view('livewire.navigation.notification-bell');
    }
}
