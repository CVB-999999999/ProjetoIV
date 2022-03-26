<div class="min-h-screen w-full  bg-white">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <div class="m-8 grid justify-items-center">
        <img class="opacity-70 w-60"  src="{{ URL('images/esce.png') }}" alt="">
    </div>
   
    <div class="space-y-6 p-7 mt-10 ">
        
        <h1 class="text-center text-8xl font-mono text-opacity-90 text-black" >Projeto 3</h1>

        <p class="font-serif text-center text-4xl text-opacity-70 text-black">Leaders For the Future</p>
    </div>
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-gradient-to-br from-pink-300 via-red-400 to-rose-600 py-8 px-6 shadow rounded-lg sm:px-10">
            <form class="mb-0 space-y-6" wire:submit.prevent="login"  method="POST" >

                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">Utilizador</label>
                    <div class="mt-1">
                        <input id="login" wire:model ="username" type="text"
                            class="border border-opacity-50 rounded border-gray-700 w-full form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="login" value="{{ old('username') }}" required autofocus>
                        
                        
                    </div>
                </div>

                <div>
                    <label for="password" class=" block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" wire:model = "password" class="border border-opacity-50 rounded border-gray-700 w-full" name="password" type="password"
                            autocomplete="current-password"  />
                            
                    </div>
                </div>

                
                @if (!$verifier)
                <div class="">
                    <h1 class=" font-semibold text-red-500"> A password utilizada está errada</h1>
                </div>
                @endif                    



                
                <div class="form-group mb-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white
                        bg-gray-600 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" wire:click.prevent="login">Login
                    </button>
                 </div>
            </form>
            
        </div>
    </div>

    
</div>

