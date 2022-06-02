<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserCreate extends Component
{
    public $firstN;
    public $lastN;
    public $emailA;
    public $typeA;
    public $nif;
    public $mNumber;

    public function render()
    {
        return view('livewire.user-create');
    }

    public function submitForm() {
        ddd($this->firstN);

        // TODO -> logic here
    }
}
