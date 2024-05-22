<?php

namespace App\Livewire;

use App\Events\DisplayEvent;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;

class DisplayComponent extends Component
{
    public $convo = [];

    public function mount() {
        $messages = Message::all();
        foreach ($messages as $message) {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message
            ];
        }
    }

    public function render()
    {
        return view('livewire.display-component');
    }

    #[On('echo:our-channel,MessageEvent')]
    public function getAllData($data) {
        $this->convo[] = [
            'username' => $data['username'],
            'message' => $data['message']
        ];
    }
}