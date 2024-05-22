<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
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

    #[On('echo:our-channel,MessageEvent')]
    public function listenForMessage($data) {
        $this->convo[] = [
            'username' => $data['username'],
            'message' => $data['message']
        ];
        $this->reset('message');
    }

    public function submitMessage() {
        MessageEvent::dispatch(Auth::user()->id, $this->message);
        $this->message = "";
    }

    public function saveMessageEvent() {
        MessageEvent::dispatch(Auth::user()->id, $this->message);
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
