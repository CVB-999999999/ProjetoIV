@extends('layouts.app')
@section('content')
    <div class="w-full">
        <div class="relative mx-auto dark:text-white">
        @livewire('add-perguntas', ['idform' => $idform])
        </div>
    </div>
@endsection