@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="md:grid md:grid-cols-2">
                <div>
                    <strong class="dark:text-white text-lg">Listagem de projetos no sistema</strong>
                </div>
                <div class="md:text-right my-2 grid grid-cols-2 md:flex md:ml-auto">
                    <div>
                        <a href="/admin/addproj" class="block bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                            <span class="material-symbols-outlined align-middle h-7">add</span>
                            Criar Projetos
                        </a>
                    </div>
                    <div>
                        <a href="/admin/addtoproj" class="block bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                            <span class="material-symbols-outlined align-middle h-7">edit_note</span>
                            Adicionar Utilizador a Projeto Existente
                        </a>
                    </div>
                </div>
            </div>

            @livewire('form-discproj')

        @endif
    </div>
@endsection
