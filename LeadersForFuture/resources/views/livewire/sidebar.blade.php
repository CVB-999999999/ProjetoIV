<div >
    
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <div class="relative min-h-screen flex">

      
      
        <!-- sidebar -->
        @if ($user)
          
        
        <div class="sidebar rounded-r-md bg-gradient-to-br from-red-400   to-rose-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
      
          <!-- logo -->
          <p class="text-center">Bem Vindo <br>{{ $nome }}</p>
      
          <!-- nav -->
          <nav>
            <a href="/menu" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-800 hover:text-white">
                Formulários
            </a>
            <a href="/modelos" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-800 hover:text-white">
                Modelos
            </a>
            <a href="/logout" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-800 hover:text-white">
                Logout
            </a>
          </nav>  
        </div>
        @endif
        <!-- content -->
        
      
    </div>
</div>