<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Home extends Component
{
    public $aluno = false;
    public $prof = false;
    public $username;
    public $password;
    public $verifier = true;
    public $user;

    public function mount(){
        if(Session::has('user')){

            return redirect()->to('/menu');

        }

        $teste = Session::get('tipo');
        
        
        if($teste == 2){
            $this->aluno = true;
        }elseif($teste == 1){
            $this->prof = true;
        }
    }
    
    public function render()
    {
        return view('livewire.home');
    }


    public function login()
    {

        $this->user = DB::select("exec buscaUser_username_pw ?, ?",[$this->username, $this->password]);

        

        if(empty($this->user)){

            $this -> verifier = false;
            
        }else{
            
            $name = $this->user[0]->nome . $this->user[0]->apelido;
            
            
            
            Session::put('user', $this->username);
            Session::put('name', $name);
            Session::put('tipo', $this->user[0]->tipo);
            
/*            
            $user = json_encode($user);

            session()->put('user', "{{$user}}");
*/              
            return redirect()->to('/menu');
            
        }
    }
}
