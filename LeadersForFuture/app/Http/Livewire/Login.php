<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $aluno = false;
    public $prof = false;
    public $username;
    public $password;
    public $verifier = true;
    public $user;
    public $remember = false;

    //------------------------------------------------------------------------------------------------------------------
    // Mount -
    //------------------------------------------------------------------------------------------------------------------
    public function mount()
    {
        // To make life easy in the form
//        if (Auth::user()->id_tipoUtilizador == 2) {
//            $this->aluno = true;
//        } elseif (Auth::user()->id_tipoUtilizador == 1) {
//            $this->prof = true;
//        }
    }

    //------------------------------------------------------------------------------------------------------------------
    // Render - Render the webpage
    //------------------------------------------------------------------------------------------------------------------
    public function render()
    {
        return view('livewire.login');
    }

    //------------------------------------------------------------------------------------------------------------------
    // Login - Checks if login and password are correct
    //------------------------------------------------------------------------------------------------------------------
    public function login()
    {
        // Creates the user object
        $user = \App\Models\User::where('email', $this->username)->where('password', $this->password)->first();

        // Tries to authenticate
        if ($user) {
//            ddd($this->remember);
            Auth::login($user, $this->remember);

            // Autentication complete
            if(Auth::check()) {
                return redirect()->to('/');
            }
        }

        // Changes the value of verifier to false
        // Basically means if password or email is incorrect
        $this->verifier = false;

        return back();
    }
}
