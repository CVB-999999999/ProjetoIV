<div>
    <div class="transition duration-150 ease-in-out m-5 dark:text-white">
        <div class="grid grid-cols-4">
            <div class="col-span-3 text-3xl p-5 text-red-600">
                Ocorreu um Erro
            </div>
            <div class="col-span-1 ml-auto">
                <button wire:click="$emit('closeModal')" class="w-6"><img src="{{ URL('images/icons/close_FILL.svg') }}"
                                                                          alt="Close Button"></button>
            </div>
        </div>

        <p class="m-5 text-lg">
            {{ $message }}
        </p>

        <button class="m-5 px-5 py-2 bg-red-500 rounded-md" wire:click="$emit('closeModal')">Ok</button>
    </div>

</div>
