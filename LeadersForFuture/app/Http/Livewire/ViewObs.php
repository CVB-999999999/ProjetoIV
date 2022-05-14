<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class ViewObs extends ModalComponent
{
    public $obs;

    public function mount($obs) {
        $this->obs = $obs;
    }


    public function render()
    {

        return view('livewire.view-obs');
    }

//    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
}
