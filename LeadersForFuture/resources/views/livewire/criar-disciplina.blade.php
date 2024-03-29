<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
                <div>
                    <label for="cod" class="block font-medium"> Codigo da disciplina </label>
                    <input wire:model="cod" name="cod" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <label for="tema" class="block font-medium"> Nome da disciplina </label>
                    <input wire:model="nome" name="nome" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <label for="sigla" class="block font-medium"> Sigla da disciplina </label>
                    <input wire:model="sigla" name="sigla" type="text" class="border border-opacity-50 rounded border-gray-700
                    w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                    <select wire:model="curso" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="curso">
                        <option selected="Curso">Curso</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->cd_curso }}">{{ $curso->cd_curso }}
                                - {{ $curso->nm_curso }}</option>
                        @endforeach
                    </select>
                </div>

                <div wire:loading.remove.delay>
                    <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                        Criar Disciplina
                    </button>
                </div>

                <div wire:loading.delay>
                    A processar a operação no servidor...
                </div>
            </div>
        </div>
    </form>
</div>
