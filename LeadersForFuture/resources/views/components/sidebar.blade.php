<div class="md:flex flex-col md:flex-row md:min-h-screen">
    <div @click.away="open = false"
         class="flex flex-col w-full md:w-48 text-gray-700 bg-zinc-200 dark:text-gray-200 dark:bg-zinc-900
             flex-shrink-0 text-center"
         x-data="{ open: false }">
        {{-- Top of Sidebar / Navbar in sm --}}
        <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between md:hidden">
            <p class="text-lg font-semibold uppercase rounded-lg dark-mode:text-white
                   focus:outline-none focus:shadow-outline text-center">
                Opções
            </p>
            {{-- Mobile Show/Hide Sidebar --}}
            <button class="rounded-lg md:hidden rounded-lg focus:outline-none focus:shadow-outline"
                    @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        {{-- Sidebar content --}}
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block p-4 md:pb-0 md:overflow-y-auto">
            <a href="/" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white inline inline-flex">
{{--                <img class="dark:invert object-contain h-5" src="{{ URL('images/icons/home_FILL.svg') }}" alt="home-icon">--}}
                Página Inicial
            </a>

            <hr class="my-5 border-esce">

            {{-- Sidebar Btns --}}
            {{-- Professor --}}
            @if(Session::get('tipo') == 1)
                {{-- Para já não vai ter nada aqui --}}
            @endif
            {{-- Student --}}
            @if(Session::get('tipo') == 2)
                <a href="/form"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
                    Formulários
                </a>
            @endif
            {{-- Admin --}}
            @if(Session::get('tipo') == 3)
                <a href="/admin/users/create"
                   class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
                    Criar Utilizadores
                </a>
                <a href="/admin/users"
                   class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
                    Gerir Utilizadores
                </a>
                <a href="/form"
                   class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
                    Estatisticas
                </a>
            @endif
        </nav>
    </div>
</div>
