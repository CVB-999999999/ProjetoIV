<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Responder extends Component
{
    public $respostas=[];

    public function render()
    {
        return view('livewire.responder');
    }
}
