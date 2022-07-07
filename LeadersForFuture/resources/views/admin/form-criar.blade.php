@extends('layouts.app')
@section('content')
    <div class="w-full">
        <div class="relative mx-auto dark:text-white">
        @livewire('form-criar', ['tpForms' => $tpForms, 'projetos' => $projetos])
        </div>
    </div>
@endsection