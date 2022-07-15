@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)
        <div class="w-full p-3">
            @livewire('form-proj')
        </div>
        @endif
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
        
        <div class="w-full p-3">
            Lista de projetos no sistema - <a href="/admin/addproj"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">add</span> Criar Projetos
    </a>
    <a href="/admin/addtoproj"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">edit_note</span> Adicionar a Projeto Existente
    </a>
            @livewire('form-adminp')
        </div>
        @endif
        {{-- Student --}}
        @if(Auth::user()->id_tipoUtilizador == 2)
            {{-- Para já não vai ter nada aqui --}}
        @endif
    </div>
@endsection
