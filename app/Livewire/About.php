<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Contact')]
class About extends Component
{
    protected $listeners = ['ubahData'];
    public $users;
    public function mount(){
        $users = User::all();
        foreach ($users as $value) {
            $data['name'][] = $value->name;
            $data['email'][] = $value->email;
        }
        $this->users = json_encode($data);
        // dd($this->users);
    }

    public function render()
    {
        $antrian = User::all();
        return view('livewire.about')->with('antrian', $antrian);
    }

    public function changeData() {
        $users = User::all();
        foreach ($users as $value) {
            $data['name'][] = $value->name;
            $data['email'][] = $value->email;
        }
        $this->users = json_encode($data);
        $this->dispatch('berhasilUpdate', ['data' => $this->users]);
    }
}