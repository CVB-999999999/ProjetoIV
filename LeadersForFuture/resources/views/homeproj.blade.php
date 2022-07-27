@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)

            <div class="md:grid md:grid-cols-2 m-2 md:m-5">
                <div>
                    <strong class="dark:text-white text-lg">
                        Listagem de Projetos Criados associados ao
                        Professor: {{Auth::user()->nome}} {{Auth::user()->apelido}}
                    </strong>
                </div>
                <div class="md:text-right my-2 grid grid-cols-2 md:flex md:ml-auto">
                    <div>
                        <a href="/prof/addproj/" class="block bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                            <span class="material-symbols-outlined align-middle h-7">add</span>
                            Criar Projetos
                        </a>
                    </div>
                    <div>
                            <a href="/prof/addtoproj" class="block bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                                <span class="material-symbols-outlined align-middle h-7">edit_note</span>
                                Adicionar a Projeto Existente
                            </a>
                        </div>

                </div>
            </div>
            @livewire('form-proj')
        @endif
        {{-- Admin --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="p-3 w-full">
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
                                Adicionar a Projeto Existente
                            </a>
                        </div>
                    </div>
                </div>

                @livewire('form-adminp')

                @endif
                {{-- Student --}}
                @if(Auth::user()->id_tipoUtilizador == 2)
                    {{-- Para já não vai ter nada aqui --}}
                @endif
            </div>
@endsection
