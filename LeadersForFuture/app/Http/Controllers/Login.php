<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;



class Login extends Component
{
    public $username;
    public $password;
    public $verifier = true;
    public $user;

    public function mount(){
        if(Session::has('user')){

            return redirect()->to('/menu');

        }


    }
    public function render()
    {

        return view('livewire.login');
    }

    public function index()
    {
        return view('auth.login');
    }  
      

    public function login()
    {

        $this->user = DB::select("exec buscaUser_numero_pw ?, ?",[$this->username, $this->password]);

        

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

      


 
    
    /*
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }*/
}
