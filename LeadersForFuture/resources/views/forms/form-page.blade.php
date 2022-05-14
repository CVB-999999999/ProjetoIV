@extends('layouts.app')
@section('content')

    <div class="w-full">
        {{-- Form --}}
        <div class="relative mx-auto dark:text-white">
            @livewire('form', ['id'=> $id])
        </div>
    </div>
@endsection
