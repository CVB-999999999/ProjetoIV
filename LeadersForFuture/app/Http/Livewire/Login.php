<?php

namespace App\Http\Livewire;

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

    //------------------------------------------------------------------------------------------------------------------
    // Mount -
    //------------------------------------------------------------------------------------------------------------------
    public function mount()
    {
        if (Session::has('user')) {
            return redirect()->to('/menu');
        }

        $teste = Session::get('tipo');

        if ($teste == 2) {
            $this->aluno = true;
        } elseif ($teste == 1) {
            $this->prof = true;
        }
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

        // Uses a SP to querry the DB with the username and password
        $this->user = DB::select("exec buscaUser_username_pw ?, ?", [$this->username, $this->password]);


        // Verifies if the SP has return anything
        if (empty($this->user)) {
            // Changes the value of verifier to false
            // Basically means if password or email is correct
            $this->verifier = false;

        } else {
            $name = $this->user[0]->nome . $this->user[0]->apelido;

            Session::put('user', $this->username);
            Session::put('name', $name);
            Session::put('tipo', $this->user[0]->tipo);

            return redirect()->to('/menu');

        }
    }
}
