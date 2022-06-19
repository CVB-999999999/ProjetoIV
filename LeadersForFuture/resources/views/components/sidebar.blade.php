<div class="md:flex flex-col md:flex-row md:min-h-screen">
    <div @click.away="open = false"
         class="flex flex-col w-0 md:w-48 text-gray-700 bg-zinc-200 dark:text-gray-200 dark:bg-zinc-900
             flex-shrink-0 text-center" x-data="{ open: false }">

        {{-- Sidebar content --}}
        <nav :class="{'block': open, 'hidden': !open}" class="flex-grow md:block p-4 md:pb-0 md:overflow-y-auto">
            <a href="/"
               class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white inline inline-flex">
                Página Inicial
            </a>

            <hr class="my-5 border-esce">

            {{-- Sidebar Btns --}}
            @include('components.nav-btns')
        </nav>
    </div>
</div>
