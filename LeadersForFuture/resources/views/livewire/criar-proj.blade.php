<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
                <div>
                    <label for="nome" class="block font-medium"> Nome do projeto </label>
                    <input wire:model="nome" name="nome" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <label for="tema" class="block font-medium"> Tema do projeto </label>
                    <input wire:model="tema" name="tema" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <label for="ano_letivo" class="block font-medium"> Ano letivo </label>
                    <input wire:model="ano_letivo" name="ano_letivo" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <label for="tema" class="block font-medium"> Disciplina do projeto </label>
                    <select wire:model="disciplina" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="disciplina">
                        <option selected="Disciplina">Disciplina</option>
                        @foreach($disciplinas as $disciplina)
                            <option value="{{ $disciplina->cd_discip }}">{{ $disciplina->cd_discip }}
                                - {{ $disciplina->ds_discip }}</option>
                        @endforeach
                    </select>
                    {{--                    <label for="tema" class="block font-medium"> Semestre do projeto </label>--}}
                    {{--                <select wire:model="semestre" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"--}}
                    {{--                            name="semestre">--}}
                    {{--                        <option selected="Semestre">Semestre</option>--}}
                    {{--                        <option value="1">Semestre 1</option>--}}
                    {{--                        <option value="2">Semestre 2</option>--}}
                    {{--                    </select>--}}
                </div>
                <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                    Criar Projeto
                </button>

                <div wire:loading.delay>
                    A carregar...
                </div>
            </div>
        </div>
    </form>
</div>
