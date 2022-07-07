@extends('layouts.app')
@section('content')

    <div class="w-full">
        <div class="relative mx-auto dark:text-white">
            @livewire('create-project', ['id' => $id])
        </div>
    </div>
@endsection
