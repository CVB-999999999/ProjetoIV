<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div>
            {{-- Password Old --}}
            <label for="passO" class="block font-medium"> Password Antiga </label>
            <input wire:model="passO" name="pass0" type="password" class="border border-opacity-50 rounded border-gray-700
            md:w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
            @error('passO') <span class="error">{{ $message }}</span> @enderror

            {{-- Password New --}}
            <label for="pass" class="block font-medium"> Password Nova </label>
            <input wire:model="pass" name="pass" type="password" class="border border-opacity-50 rounded border-gray-700
            md:w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
            @error('pass') <span class="error">{{ $message }}</span> @enderror

            {{-- Password New Confirm --}}
            <label for="passC" class="block font-medium"> Confirmar Password Nova </label>
            <input wire:model="passC" name="passC" type="password" class="border border-opacity-50 rounded border-gray-700
            md:w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
            @error('passC') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
            Atualizar Password
        </button>

        <div wire:loading.delay>
            A processar a operação no servidor...
        </div>
    </form>
</div>
