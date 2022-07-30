@extends('layouts.app')
@section('content')

    <div class="mx-5 mt-3 dark:text-white text-lg">

        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="px-3">
                Listagem de Projetos Afetos aos Alunos
            </div>
        @endif
        
         @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="px-3">
                Listagem de Projetos Afetos aos Utilizadores
            </div>
        @endif
        
        <div class="relative flex-shrink my-2 mx-auto dark:text-white">
            @livewire('form-table')
        </div>
    </div>
@endsection
