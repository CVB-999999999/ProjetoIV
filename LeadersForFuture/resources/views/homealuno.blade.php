@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)
        <div class="w-full p-3">
            @livewire('form-aluno')
        </div>
        @endif
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
        <div class="w-full p-3">
            @livewire('form-alunoadmin')
        </div>
        @endif
        
        {{-- Student --}}
        @if(Auth::user()->id_tipoUtilizador == 2)
            {{-- Para já não vai ter nada aqui --}}
        @endif
    </div>
@endsection