@extends('layouts.app')
@section('content')

    <div class="w-full p-3">
        <h1 class="dark:text-white text-3xl text-center my-5"> Informação do Utilizador</h1>

        {{-- User Not Found --}}
        @if(empty($user))
            <h2 class="dark:text-white text-2xl text-center my-10"> Não foi possivel encontrar o utilizador</h2>
        @endif

        @foreach($user as $u)
            {{-- User Info --}}
            <div class="bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 md:m-10">
                <div class="lg:grid lg:grid-cols-2 mb-3">
                    <div>
                        <p class="my-1">Nome: {{ $u->nome}} {{ $u->apelido}}</p>
                        <p class="my-1">Email: {{ $u->email }}</p>
                    </div>
                    <div class="lg:text-right">
                        <p class="my-1">Número Mecanografico: {{$u->numero}}</p>
                        <p class="my-1">Tipo de Utilizador: <span class="capitalize"> {{$u->descricao}} </span></p>
                    </div>
                </div>

                @if(Auth::user()->id_tipoUtilizador == 3)
                    <a href="/admin/users/{{ trim($u->numero) }}/update"
                       class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2">
                        <span class="material-symbols-outlined align-middle h-7">edit</span> Editar Utilizador
                    </a>
                @endif
                
            </div>

            {{-- Form Info --}}
            <h2 class="dark:text-white text-2xl text-center my-5"> Formulários</h2>
            <div class="bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 md:m-10">
                @php($aux = "")
                @foreach($forms as $form)
                    {{-- Verify if project header has been displayed --}}
                    @if(!($aux === $form->nome))
                        {{-- Only puts the line and closes the div after thee fists loop as ended --}}
                        @if($aux != "")
            </div>
            <hr class="border-esce my-2">
            @endif
            {{-- Header --}}
            <div class="bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10">
                <h2 class="text-center text-2xl"> {{ $form->nome }} </h2>
                <div class="lg:grid lg:grid-cols-2">
                    <div>
                        Disciplina: {{ $form->id_Disciplina }}
                    </div>
                    <div class="lg:text-right">
                        Tema do Projeto: {{ $form->tema }}
                    </div>
                </div>
            </div>

            <div class="lg:grid lg:grid-cols-2">
                @endif
                {{-- Form Info --}}
                @php($aux = $form->nome)

                <div
                    class="xl:grid xl:grid-cols-2 bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 ">
                    <div>
                        <p class="rounded px-4 py-2 w-full text-center">Ano Letivo: {{ $form->ano_letivo }}</p>
                        <p class="rounded px-4 py-2 w-full text-center"> {{ $form->ano_curricular }}º
                            ano {{ $form->semestre + 1 }}º semestre</p>
                        <div class="rounded px-4 py-2 w-full text-center">
                            <p> Estado: </p>
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
                        </div>
                    </div>
                    <div class="xl:text-right">
                        {{-- Only show view form btn to teacher --}}
                        @if($form->estado == 0)
                            <form action="/form/{{trim($form->id)}}/enable">
                                <button class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce
                                                hover:text-white px-4 py-2 w-full text-center" type="submit">
                                    <span class="material-symbols-outlined align-middle h-7">lock_open</span>
                                    Ativar Formulário
                                </button>
                            </form>
                        @endif

                        @if(Auth::user()->id_tipoUtilizador == 1)
                            <div class="my-3">
                                <a class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 block text-center"
                                   href="/form/{{trim($form->id)}}">
                                    <span class="material-symbols-outlined align-middle h-7">visibility</span>
                                    Ver Form
                                </a>
                            </div>
                            <div>
                                <a href="/form/addPerguntas/{{$form->id}}"
                                   class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 block text-center">
                                    <span class="material-symbols-outlined align-middle h-7">add</span>
                                    Adicionar Perguntas
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @break
        @endforeach
    </div>
@endsection
