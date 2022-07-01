@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="w-full p-3">
                @livewire('form-table')
            </div>
            {{-- Admin and Studenet --}}
        @else
            @include('info-project')
        @endif
    </div>
@endsection
