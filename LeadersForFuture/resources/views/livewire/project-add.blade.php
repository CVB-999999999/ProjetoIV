<div>
    <form wire:submit.prevent="submit" method="POST" class="md:m-7 m-3">
        <div>
            <div>
                <p>Aluno: {{ $alunoId }}</p>
                <p>Professor: {{ Auth::user()->numero }}</p>
            </div>

            <select wire:model="projId" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2" name="projetos">
                <option selected="Tipo Formulário">Formulário</option>
                @foreach($query as $q)
                    <option value="{{ $q->id }}">{{ $q->nome }}</option>
                @endforeach
            </select>
        </div>

        <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
            Adicionar ao Projeto
        </button>

        <div wire:loading.delay>
            A carregar...
        </div>
    </form>
</div>
