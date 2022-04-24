<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Models extends Component
{
    public $forms = [];

    public function render()
    {
        // Get user number
        $username = Session::get('user');

        $this->forms = DB::select("exec buscaFormsDados ?", [$username]);

        return view('livewire.models');
    }
}
