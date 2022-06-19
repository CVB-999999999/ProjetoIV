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
                <div class="md:grid md:grid-cols-2">
                    <div>
                        <p class="my-1">Nome: {{ $u->nome}} {{ $u->apelido}}</p>
                        <p class="my-1">Email: {{ $u->email }}</p>
                    </div>
                    <div class="md:text-right">
                        <p class="my-1">Número Mecanografico: {{$u->numero}}</p>
                        <p class="my-1">Tipo de Utilizador: <span class="capitalize"> {{$u->descricao}} </span></p>
                    </div>
                </div>
            </div>

            {{-- Form Info --}}
            <h2 class="dark:text-white text-2xl text-center my-5"> Formulários</h2>

            <div class="bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 md:m-10">
{{--                <button class="block bg-esce px-5 py-2 rounded-md text-white mx-auto"> Inscrever num Projeto</button>--}}

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
                            <div class="md:grid md:grid-cols-2">
                                <div>
                                     Disciplina: {{ $form->id_Disciplina }} - Nome da disciplina (alterar o SP para adicionar o nome da disciplina)
                                </div>
                                <div class="md:text-right">
                                    Tema do Projeto: {{ $form->tema }}
                                </div>
                            </div>
                        </div>

                        <div class="md:grid md:grid-cols-2">
                    @endif
                    {{-- Form Info --}}
                        @php($aux = $form->nome)

                        <div class="md:grid md:grid-cols-2 bg-zinc-300 dark:bg-zinc-600 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 ">

                            <div>
                                <p>Ano Letivo: {{ $form->ano_letivo }}</p>
                                <p> {{ $form->ano_curricular }}º ano {{ $form->semestre + 1 }}º semestre</p>
                            </div>

                            <div class="md:text-right">
                                Estado:

                                @switch($form->estado)
                                    @case(0)
                                        Bloqueado
                                        @break
                                    @case(1)
                                        Aberto
                                        @break
                                    @case(2)
                                        Em avaliação
                                        @break
                                    @case(3)
                                        Bloqueado
                                        @break
                                    @default
                                        Desconhecido
                                @endswitch
                            </div>
                        </div>
                @endforeach
            </div>

            {{-- TODO - Livewire com a seleção do formulario a preencher --}}

            @break
        @endforeach

    </div>

@endsection
