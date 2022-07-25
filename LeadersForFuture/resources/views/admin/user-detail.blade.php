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

            {{-- Project Info --}}
            <h2 class="dark:text-white text-2xl text-center my-5"> Projetos Inscritos</h2>
            <div class="bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 md:m-10">
                @php($aux = "")
                @foreach($forms as $form)
                    <div class="bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10">
                        <h2 class="text-center text-2xl" id="{{ trim($form->id_projecto) }}"> {{ $form->nome }} </h2>
                        <div class="lg:grid lg:grid-cols-2">
                            <div>
                                Disciplina: {{ $form->id_Disciplina }} - {{ $form->ds_discip }}
                            </div>
                            <div class="lg:text-right my-2">
                                Tema do Projeto: {{ $form->tema }}
                            </div>
                            <div>
                                Ano Letivo de Inicio: {{ $form->ano_letivo }} / {{ $form->ano_letivo + 1 }}
                            </div>
                            <div class="lg:text-right my-2 mt-4">
                                <a href="/admin/aluno/{{ trim($form->id_projecto) }}"
                                        class="bg-zinc-400 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2">
                                    <span class="material-symbols-outlined align-middle h-7">article</span>
                                    Ver Detalhes do Projeto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @break
        @endforeach
    </div>
@endsection
