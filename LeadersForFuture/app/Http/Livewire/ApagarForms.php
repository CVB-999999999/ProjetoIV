<?php

namespace App\Http\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ApagarForms extends ModalComponent
{
    public $idU;

    public function mount($id)
    {
        $this->idU = $id;
    }

    public function render()
    {
        return view('livewire.apagar-forms');
    }

    //    Set MaxWidth for the modal
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
