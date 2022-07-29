<div>
    <div class="mt-3">
        <p class="text-lg md:mx-7 mx-3"> Projeto: {{trim($projeto[0]->nome)}} </p>
        <p class="text-lg md:mx-7 mx-3"> ID Formulário: {{$idform}} </p>
    </div>

    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
                <label for="pergunta" class="block font-medium"> Pergunta </label>
                <input wire:model="pergunta" name="pergunta" type="text" class="border border-opacity-50 rounded border-gray-700
                w-full py-1 px-2 mb-3 dark:bg-zinc-700">
                {{--                <input wire:model="idform" name="idform" type="hidden" class="border border-opacity-50 rounded border-gray-700--}}
                {{--                w-full py-1 px-2 mb-3 dark:bg-zinc-700">--}}
                <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                    Adicionar Pergunta
                </button>

                <div wire:loading.delay>
                    A carregar...
                </div>
            </div>
        </div>
    </form>
</div>
