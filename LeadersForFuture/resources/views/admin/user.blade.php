@extends('layouts.app')
@section('content')

    <div class="w-full p-3">
        <div class="md:grid md:grid-cols-2">
            <div>
                <strong class="dark:text-white text-lg">Listagem de utilizadores</strong>
            </div>
            <div class="md:text-right my-2">
                <a href="/admin/users/create" class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white
                px-4 py-2 dark:text-white">

                    <span class="material-symbols-outlined align-middle h-7">add</span>
                    Criar Utilizadores

                </a>
            </div>
        </div>

        @livewire('admin-table')
    </div>

@endsection
