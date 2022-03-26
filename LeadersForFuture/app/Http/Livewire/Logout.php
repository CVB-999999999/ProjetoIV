<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Logout extends Component
{
    public function mount(){

        session()->flush();
        
        return redirect()->to('/');

    }
    public function render()
    {
        return view('livewire.logout');
    }
}
