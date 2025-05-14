<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class TaskAssigned extends Notification //implements ShouldQueue
{
    use Queueable;

    public $task;
    public $admin;

    public function __construct($task, $admin)
    {
        // dd($admin);
        $this->task = $task;
        $this->admin = $admin;
    }

    public function via($notifiable)
    {
        return ['database']; // You can add 'mail' or 'broadcast' if needed
    }

    public function toDatabase($notifiable)
    {
        // dd($this->task);
        // dd($this->admin);
        return [
            'task' => $this->task,
            'admin' => $this->admin,
            'message' => 'You have been assigned new tasks.',
            'created_at' => now(),
        ];
    }
}
