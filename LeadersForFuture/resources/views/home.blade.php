@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)
        <div class="w-full p-3">
            @livewire('form-table')
        </div>
        @endif
        {{-- Student --}}
        @if(Auth::user()->id_tipoUtilizador == 2)
            {{-- Para já não vai ter nada aqui --}}
        @endif
    </div>
@endsection
