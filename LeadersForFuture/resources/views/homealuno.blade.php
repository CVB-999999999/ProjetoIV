@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">

        <div class="mx-5 mt-3 dark:text-white text-lg">
            Listagem de Utilizadores Afetos ao Projeto: <strong>{{$proj->nome}}</strong>
        </div>

        {{-- Professor --}}

        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="px-3">
                @livewire('form-aluno')
            </div>
        @endif
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="px-3">
                @livewire('form-aluno-admin')
            </div>
        @endif

        <div class="xl:grid xl:grid-cols-2">
            @foreach($forms as $index=>$form)
                <div class="bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10">
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

                    {{-- Only show view form btn to teacher --}}
                    {{--                    @if(Auth::user()->id_tipoUtilizador == 1)--}}
                    @if($form->estado == 0)
                        <form action="/form/{{trim($form->id)}}/enable">
                            <button class="mt-3 bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce
                                                hover:text-white px-4 py-2 w-full text-center" type="submit">
                                <span class="material-symbols-outlined align-middle h-7">lock_open</span>
                                Ativar Formulário
                            </button>
                        </form>
                    @endif
                    @if($form->estado == 0)
                        <div>
                            <a href="/form/addPerguntas/{{$form->id}}"
                               class="mt-3 bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 block text-center">
                                <span class="material-symbols-outlined align-middle h-7">add</span>
                                Adicionar Perguntas
                            </a>
                        </div>

                        <div>
                            <button class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2
                                mt-3 w-full text-center" type="submit"
                                    onclick="Livewire.emit('openModal', 'del-questions', {{ json_encode(["id" => $form->id]) }})">
                                <span class="material-symbols-outlined align-middle h-7">delete</span>
                                Apagar Perguntas
                            </button>
                        </div>
                    @endif
                    {{--                    @endif--}}
                    @if($form->estado == 0)
                        <button class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2
                                mt-3 w-full text-center" type="submit"
                                onclick="Livewire.emit('openModal', 'apagar-forms', {{ json_encode(["id" => $form->id]) }})">
                            <span class="material-symbols-outlined align-middle h-7">delete</span>
                            Apagar Formulário
                        </button>
                    @endif
                </div>

            @endforeach
        </div>
    </div>
@endsection
