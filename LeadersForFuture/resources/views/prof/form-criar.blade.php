@extends('layouts.app')
@section('content')
    <div class="w-full">
        <div class="relative mx-auto dark:text-white">
        @livewire('form-prof', ['tpForms' => $tpForms, 'projetos' => $projetos])
        </div>
    </div>
@endsection