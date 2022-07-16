@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        
        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="w-full p-3">
            <strong class="dark:text-white text-lg">Listagem de de alunos afetos ao projeto: {{$proj->nome}}</strong> 
           
                @livewire('form-aluno')
            </div>
        @endif
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="w-full p-3">
                @livewire('form-aluno-admin')
            </div>
        @endif
    </div>
@endsection
