<div>
    <div class="transition duration-150 ease-in-out m-5 dark:text-white">
        <div class="grid grid-cols-4">
            <div class="col-span-3 text-3xl p-5 text-red-500">
                Aviso
            </div>
            <div class="col-span-1 ml-auto">
                <button wire:click="$emit('closeModal')" class="w-6">
                    <img src="{{ URL('images/icons/close_FILL.svg') }}" alt="Close Button">
                </button>
            </div>
        </div>

        @if($query->isEmpty())
            <p class="m-5 text-lg">
                Este formulário não tem perguntas para eliminar!
            </p>

            <button class="m-5 px-5 py-2 bg-red-500 rounded-md" wire:click="$emit('closeModal')">Ok</button>
        @else
            <p class="m-5 text-lg">
                <label for="state" class="ml-1"> Selecione a pergunta a eliminar</label>

                <select wire:model="apr" id="state" name="state" class="form-select appearance-none block w-full px-3 py-1.5
                                bg-clip-padding bg-no-repeat rounded transition bg-zinc-200 dark:bg-zinc-900 dark:text-white
                                ease-in-out m-0 focus:outline-none" required>

                    <option selected>Escolha uma opção</option>

                    @foreach($query as $q)
                        <option value="{{ $q->id_pergunta }}">
                            {{ $q->Pergunta }}
                        </option>
                    @endforeach
                </select>
            </p>

            <button class="m-5 px-5 py-2 bg-gray-500 rounded-md" wire:click="func">Sim</button>
            <button class="m-5 px-5 py-2 bg-red-500 rounded-md" wire:click="$emit('closeModal')">Não</button>
            <div wire:loading.delay>
                A carregar...
            </div>
        @endif
    </div>
</div>
