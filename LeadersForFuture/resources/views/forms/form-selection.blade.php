@extends('layouts.app')
@section('content')

    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 3)
            <div class="md:grid md:grid-cols-2 m-2 md:m-5">
                <div class="md:text-right my-2 md:ml-auto">
                    <div><strong class="dark:text-white text-lg">Listagem de formulários no sistema</strong></div>
                    <div>
                        <a href="/admin/addform/" class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                            <span class="material-symbols-outlined align-middle h-7">add</span>
                            Criar Formulário
                        </a>
                    </div>
                </div>
            </div>
        @endif
        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="md:grid md:grid-cols-2 m-2 md:m-5">
                <div class="md:text-right my-2 md:ml-auto">
                    <div><strong class="dark:text-white text-lg">Listagem de formulários do professor</strong></div>
                    <div class="my-2 text-center ">
                        <a href="/prof/addform/" class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce
                                hover:text-white px-4 py-2 dark:text-white mx-2">
                            <span class="material-symbols-outlined align-middle h-7">add</span>
                            Criar Formulário
                        </a>
                    </div>
                </div>
            </div>
        @endif
        @livewire('form-select-std')
    </div>
@endsection
