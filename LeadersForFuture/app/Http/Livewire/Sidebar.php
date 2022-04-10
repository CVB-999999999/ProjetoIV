<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Sidebar extends Component
{


    public function mount()
    {

        /*$tipo = session()->get('tipo', function () {
            return 'default';
        });*/


    }

    public function render()
    {
        return view('livewire.sidebar');
    }

    public function logout()
    {


    }
}
