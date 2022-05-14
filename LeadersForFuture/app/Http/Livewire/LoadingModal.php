<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class LoadingModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.loading-modal');
    }
}
