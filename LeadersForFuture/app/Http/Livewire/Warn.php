<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class Warn extends ModalComponent
{
    public $message;

    public function mount($message)
    {
        $this->$message = $message;
    }

    public function render()
    {
        return view('livewire.warn');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
