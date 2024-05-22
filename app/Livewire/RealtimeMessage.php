<?php

namespace App\Livewire;

use App\Events\SendRealTimeMessage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\On;

class RealtimeMessage extends Component
{
    public string $message;
    use LivewireAlert;

    public function triggerEvent(): void {
        event(new SendRealTimeMessage($this->message));
    }

    #[On('echo:my-channel, SendRealTimeMessage')]
    public function handleRealtimeMessage($message): void {
        dd($message);
        $this->alert("success", "Realtime message");
    }

    public function render()
    {
        return view('livewire.realtime-message');
    }
}