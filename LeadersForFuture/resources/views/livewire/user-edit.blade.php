<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div>
            Nome
            <div class="border border-opacity-50 rounded border-gray-700 w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                {{ $firstN }} {{ $lastN }}
            </div>

            Email
            <div class="border border-opacity-50 rounded border-gray-700 w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                {{ $emailA }}
            </div>

            Número Mecanografico
            <div class="border border-opacity-50 rounded border-gray-700 w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                {{ $mNumber }}
            </div>

            {{-- Password --}}
            <label for="number" class="block font-medium"> Password </label>
            <input wire:model="pass" name="number" type="password" class="border border-opacity-50 rounded border-gray-700
            w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
        </div>

        <div>
            <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                <span class="material-symbols-outlined align-middle h-7">check</span>
                Atualizar Utilizador
            </button>

            <button wire:click.prevent="del"
                    class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                <span class="material-symbols-outlined align-middle h-7">delete</span>
                Apagar Utilizador
            </button>
        </div>
    </form>
</div>
