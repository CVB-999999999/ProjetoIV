<div>
    <form wire:submit.prevent="submit" method="POST" class="md:m-7 m-3">
        <div>
            <div>
                <p>
                    Aluno: {{ $alunoId }}
                </p>
                <p>
                    Professor: {{ Auth::user()->numero }}
                </p>
            </div>

            {{-- Project Name --}}
            <label for="name" class="block font-medium"> Nome do Projeto </label>
            <input wire:model="name" name="name" type="text" class="border border-opacity-50 rounded border-gray-700
            w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
            {{-- Project Theme --}}
            <label for="theme" class="block font-medium"> Tema do Projeto </label>
            <input wire:model="theme" name="theme" type="text" class="border border-opacity-50 rounded border-gray-700
            w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
            {{-- Course ID --}}
            <label for="cid" class="block font-medium"> Id da Disciplina </label>
            <input wire:model="cid" name="cid" type="text" class="border border-opacity-50 rounded border-gray-700
            w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
        </div>

        <div wire:loading.remove.delay>
            <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                Criar Projeto
            </button>
        </div>

        <div wire:loading.delay>
            A processar a operação no servidor...
        </div>
    </form>
</div>
