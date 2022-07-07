<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
            <select wire:model="tpForm" class="form-control m-bot15" name="tpForm">
                <option selected="Tipo Formulário">Tipo Formulário</option>
                @foreach($tpForms as $tpForm)
                    <option value="{{ $tpForm->id }}">{{ $tpForm->descricao }}</option>
                @endforeach
            </select>
            <select wire:model="projeto" class="form-control m-bot15" name="projetos">
                <option selected="Tipo Formulário">Projeto</option>
                @foreach($projetos as $projeto)
                    <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>
                @endforeach
            </select>
            <select wire:model="semestre" class="form-control m-bot15" name="semestre">
                <option selected="Semestre">Semestre</option>
                    <option value="1">Semestre 1</option>
                    <option value="2">Semestre 2</option>
            </select>
            <select wire:model="anocurricular" class="form-control m-bot15" name="anocurricular">
                <option selected="Anocurricular">Ano curricular</option>
                    <option value="1">1º Ano</option>
                    <option value="2">2º Ano</option>
                    <option value="3">3º Ano</option>
            </select>
            <label for="ano_letivo" class="block font-medium"> Ano Letivo </label>
            <input wire:model="ano_letivo" name="ano_letivo" type="text" class="border border-opacity-50 rounded border-gray-700
                w-full py-1 px-2 mb-3 dark:bg-zinc-700">
                <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                Criar Form
            </button>
            </div>
        </div>
    </form>
</div>