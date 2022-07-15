@extends('layouts.app')
@section('content')

    <div class="w-full p-3">
        Listagem de utilizadores - 
    <a href="/admin/users/create"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">add</span> Criar Utilizadores
    </a>
        @livewire('admin-table')
    </div>

@endsection
