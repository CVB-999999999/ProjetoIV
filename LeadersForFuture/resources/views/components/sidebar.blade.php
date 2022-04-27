@if($user)
    <div class="md:flex flex-col md:flex-row md:min-h-screen">
        <div @click.away="open = false"
             class="flex flex-col w-full md:w-64 text-gray-700 bg-zinc-200 dark:text-gray-200 dark:bg-zinc-900 flex-shrink-0"
             x-data="{ open: false }">
            {{-- Top of Sidebar / Navbar in sm --}}
            <div class="flex-shrink-0 px-8 py-4 flex flex-row items-center justify-between">
                <a href="/"
                   class="text-lg font-semibold uppercase rounded-lg dark-mode:text-white
                   focus:outline-none focus:shadow-outline text-center">
                    Leaders For The Future
                </a>
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
            <nav :class="{'block': open, 'hidden': !open}"
                 class="flex-grow md:block px-4 pb-4 md:pb-0 md:overflow-y-auto">

                <p class="text-center"> Bem Vindo <br> {{ $nome }} </p>

                <hr class="my-5 border-esce">

                {{-- Sidebar Btns --}}
                {{-- Professor --}}
                @if($prof)
                    {{-- Para já não vai ter nada aqui --}}
                @endif
                {{-- Student --}}
                @if($aluno)
                    <a href="/form"
                       class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-800 hover:text-white">
                        Formulários
                    </a>
                @endif
                <a href="/logout"
                   class="block py-2.5 px-4 rounded transition duration-200 hover:bg-red-800 hover:text-white">
                    Logout
                </a>
            </nav>
        </div>
    </div>

@endif
