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
                    <div class="my-1">
                        Nome: {{ $u->nome}} {{ $u->apelido}}
                    </div>
                    <div class="my-1">
                        Número Mecanografico: {{$u->numero}}
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2">
                    <div class="my-1">
                        Email: {{ $u->email }}
                    </div>
                    <div class="my-1">
                        Tipo de Utilizador: <span class="capitalize"> {{$u->descricao}} </span>
                    </div>
                </div>
            </div>

            {{-- Form Info --}}
            <h2 class="dark:text-white text-2xl text-center my-5"> Formulários</h2>

            <div class="bg-zinc-200 dark:bg-zinc-700 dark:text-zinc-200 rounded-md p-5 m-3 md:p-10 md:m-10">
                <button class="block bg-esce px-5 py-2 rounded-md text-white"> Inscrever num formulario</button>

                {{-- TODO -> colocar aqui a info do formulario inscrito (se existir) --}}
            </div>

            {{-- TODO - Livewire com a seleção do formulario a preencher --}}

            @break
        @endforeach

    </div>

@endsection
