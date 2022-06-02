@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Session::get('tipo') == 1)
            <div class="m-1 md:m-5">
                @livewire('menu')
            </div>
        @endif
        {{-- Student --}}
        @if(Session::get('tipo') == 2)
            {{-- Para já não vai ter nada aqui --}}
        @endif
    </div>
@endsection
