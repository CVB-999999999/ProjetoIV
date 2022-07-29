<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
                <div>
                    <p class="text-2xl my-2"> Criar um Formulário para associar a um Projeto</p>

                    <select wire:model="projeto" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="projetos">
                        <option selected="Tipo Formulário">Projeto</option>
                        @foreach($projetos as $projeto)
                            <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>
                        @endforeach
                    </select>
                    <select wire:model="semestre" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="semestre">
                        <option selected="Semestre">Semestre</option>
                        <option value="1">Semestre 1</option>
                        <option value="2">Semestre 2</option>
                    </select>
                    <label for="anocurricular" class="block font-medium"> Ano Curricular </label>
                    <input wire:model="anocurricular" name="anocurricular" type="number" class="border border-opacity-50 rounded border-gray-700
                w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
{{--                    <select wire:model="anocurricular" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"--}}
{{--                            name="anocurricular">--}}
{{--                        <option selected="Anocurricular">Ano curricular</option>--}}
{{--                        <option value="1">1º Ano</option>--}}
{{--                        <option value="2">2º Ano</option>--}}
{{--                        <option value="3">3º Ano</option>--}}
{{--                    </select>--}}
                    <label for="ano_letivo" class="block font-medium"> Ano Letivo </label>
                    <input wire:model="ano_letivo" name="ano_letivo" type="text" class="border border-opacity-50 rounded border-gray-700
                w-1/2 py-1 px-2 mb-3 dark:bg-zinc-700">
                </div>
                <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                    <span class="material-symbols-outlined align-middle h-7">add</span>
                    Criar Formulário
                </button>

                <button wire:click.prevent="proj()"
                        class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                    <span class="material-symbols-outlined align-middle h-7">menu_book</span> Ver Formulários do Projeto
                    Selecionado
                </button>

                <div wire:loading.delay>
                    A processar a operação no servidor...
                </div>

                <div class="xl:grid xl:grid-cols-2">
                    @foreach($forms as $index=>$form)

                        @switch($form->estado)
                            @case(0)
                            <div class="bg-orange-500 rounded-md p-5 m-3 md:p-10">
                                @break
                            @case(1)
                                <div class="bg-green-600 rounded-md p-5 m-3 md:p-10">
                                @break
                            @case(2)
                                <div class="bg-purple-600 rounded-md p-5 m-3 md:p-10">
                                @break
                            @case(3)
                                <div class="bg-cyan-600 rounded-md p-5 m-3 md:p-10">
                                @break
                            @default
                                <div class="bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10">
                        @endswitch

                        <p> # {{ $index + 1 }}</p>

                        <p class="rounded px-4 pb-2 w-full text-center">Ano Letivo: {{ $form->ano_letivo }}</p>
                        <p class="rounded px-4 py-2 w-full text-center"> {{ $form->ano_curricular }}º
                            ano {{ $form->semestre + 1 }}º semestre</p>
                        <p class="rounded px-4 py-2 w-full text-center"> Estado:
                            @switch($form->estado)
                                @case(0)
                                    <span class="material-symbols-outlined align-middle h-7">lock</span>
                                    Bloqueado
                                    @break
                                    @case(1)
                                        <span class="material-symbols-outlined align-middle h-7">lock_open</span>
                                        Aberto
                                        @break
                                    @case(2)
                                        <span class="material-symbols-outlined align-middle h-7">history_edu</span>
                                        Em avaliação
                                        @break
                                    @case(3)
                                        <span class="material-symbols-outlined align-middle h-7">check_small</span>
                                        Terminado
                                        @break
                                    @default
                                        <span class="material-symbols-outlined align-middle h-7">question_mark</span>
                                        Desconhecido
                                @endswitch
                            </p>
                            <div class="mt-3">
                                <a class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 block
                            text-center" href="/form/{{$form->id}}">
                                    <span class="material-symbols-outlined align-middle h-7">description</span>
                                    Ir para o formulário
                                </a>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </form>
</div>
