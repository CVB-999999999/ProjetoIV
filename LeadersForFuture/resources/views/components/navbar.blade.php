<div class="z-50 w-full text-gray-700 bg-zinc-200 dark:text-gray-200 dark:bg-zinc-900 sticky top-0">
    <div x-data="{ open: false }" class="flex flex-col px-4 md:items-center md:justify-between
        md:flex-row md:px-6 lg:px-8">
        {{-- Phone Nav --}}
        <div class="flex flex-row justify-between">
            {{-- Title --}}
            <a href="/" class="text-lg font-semibold uppercase focus:outline-none focus:shadow-outline">
                <span class="inline-flex">
                    <img src="{{ URL('/images/esce.png') }}" alt="ESCE Logo" class="h-12 p-0 hidden md:flex my-auto">
                    <span class="ml-2 p-4"> Leaders For the Future</span>
                </span>
            </a>
            {{-- Phone nav icon --}}
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
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
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex
            md:justify-end md:flex-row">
            {{-- Nav Bar content Here --}}
            <a href=/download>Manual de Instruções</a>
            {{-- DropDown --}}
            <div @click.away="open = false" class="relative z-40" x-data="{ open: false }">

                {{-- Btns that only show in nav when low width --}}
                <div class="md:hidden">
                    @include('components.nav-btns')
                </div>

                {{-- Profile Options --}}
                <button @click="open = !open"
                        class="min-w-20 flex flex-row items-center mt-2 font-semibold md:inline md:mt-0 md:ml-4 block py-2.5 px-4
                            rounded transition duration-200 hover:bg-esce hover:text-white">
                    <span> {{ Auth::user()->nome }} {{ Auth::user()->apelido }} </span>

                    {{-- DropDown Icon --}}
                    <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                         class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 w-full md:w-56 mt-2 origin-top-right">
                    {{-- Dropdown Content --}}
                    <div class="p-4 rounded-md shadow-lg bg-zinc-200 dark:bg-zinc-700 text-center">
                        <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white"
                           href="/users/passwdreset">
                            <span class="material-symbols-outlined align-middle h-7">lock</span> Alterar Password
                        </a>

                        <a class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white"
                           href="/logout">
                            <span class="material-symbols-outlined align-middle h-7">logout</span> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
