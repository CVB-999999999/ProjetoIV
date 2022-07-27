<div>
    <div class="transition duration-150 ease-in-out m-5 dark:text-white">
        <div class="grid grid-cols-4 p-5">
            <div class="col-span-3 text-3xl ml-5">
                Observações do Docente
            </div>
            <div class="col-span-1 ml-auto">
                <button wire:click="$emit('closeModal')" class="w-6"> <img src="{{ URL('images/icons/close_FILL.svg') }}" alt="Close Button"></button>
            </div>
        </div>

        <p class="m-5 p-5">
            {{ $obs }}
        </p>
    </div>
</div>
