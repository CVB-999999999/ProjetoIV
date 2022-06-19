<?php

namespace App\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class Success extends ModalComponent
{
    public $message;

    public function mount($message)
    {
        $this->$message = $message;
    }

    public function render()
    {
        return view('livewire.success');
    }

//    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
