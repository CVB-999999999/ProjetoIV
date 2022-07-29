@extends('layouts.app')
@section('content')

    <div class="mx-5 mt-3 dark:text-white text-lg">
        Listagem de Projetos Afetos aos Alunos


        <div class="relative flex-shrink my-2 mx-auto dark:text-white">
            @livewire('form-table')
        </div>
    </div>
@endsection
