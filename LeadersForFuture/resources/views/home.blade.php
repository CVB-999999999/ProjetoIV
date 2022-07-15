@extends('layouts.app')
@section('content')

    {{-- Semester and year selector --}}
    <div class="w-full min-h-screen">
        {{-- Professor --}}
        @if(Auth::user()->id_tipoUtilizador == 1)
            <div class="p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                @livewire('form-table')
            </div>

            <div class="md:grid md:grid-cols-2 p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                <div>
                    <p class="text-center text-lg my-2 dark:text-white">Diagrama de Casos de Uso</p>
                    <img class="p-1 text-center mx-auto bg-white" src="{{ URL('images/CasosUsoLFF-Professor.png') }}"
                         alt="Casos de Uso Professor">
                </div>
                <div>
                    <div>
                        <p class="text-center text-lg my-2 dark:text-white">
                            Diagrama do Fluxo para Criar um Novo Projeto
                        </p>

                        <img class="p-1 text-center mx-auto bg-white" src="{{ URL('images/Fluxo-ProjetoNovo.png') }}"
                             alt="Fluxo Projeto Novo">
                    </div>
                    <div>
                        <p class="text-center text-lg my-2 dark:text-white">
                            Diagrama do Fluxo para Adicionar um Estudante a um Projeto Existente
                        </p>

                        <img class="p-1 text-center mx-auto bg-white"
                             src="{{ URL('images/Fluxo-ProjetoExistente.png') }}" alt="Fluxo Projeto Existente">
                    </div>
                    <div>
                        <p class="text-center text-lg my-2 dark:text-white">
                            Diagrama de Fluxo para a Avaliação dos Formulários
                        </p>

                        <img class="p-1 text-center mx-auto bg-white"
                             src="{{ URL('images/Fluxo-FormuláriosProf.png') }}" alt="Fluxo Formulários">
                    </div>
                </div>
            </div>
            {{-- Student --}}
        @elseif(Auth::user()->id_tipoUtilizador == 2)
            <div class="p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                @include('info-project')
            </div>

            <div class="md:grid md:grid-cols-2 p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                <div>
                    <p class="text-center text-lg my-2 dark:text-white">Diagrama de Casos de Uso</p>

                    <img class="p-1 text-center mx-auto bg-white" src="{{ URL('images/CasosUsoLFF-Aluno.png') }}"
                         alt="Casos de Uso Aluno"></div>
                <div>
                    <p class="text-center text-lg my-2 dark:text-white">
                        Diagrama de Fluxo para o Preenchimento dos Formulários
                    </p>
                    
                    <img class="p-1 text-center mx-auto bg-white" src="{{ URL('images/Fluxo-FormuláriosAluno.png') }}"
                         alt="Fluxo Formulários">
                </div>
            </div>
            {{-- Admin --}}
        @elseif(Auth::user()->id_tipoUtilizador == 3)
            <div class="p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                @include('info-project')
            </div>

            <div class="md:grid md:grid-cols-2 p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                <div>
                    <p class="text-center text-lg my-2 dark:text-white">Diagrama de Casos de Uso</p>

                    <img class="p-1 md:p-5 text-center mx-auto bg-white" src="{{ URL('images/CasosUsoLFF-Admin.png') }}"
                         alt="Casos de Uso Admin"></div>
                <div>
                    <div class="p-5">
                        <p class="text-center text-lg my-2 dark:text-white">
                            Diagrama de Fluxo para criar um projeto novo
                        </p>

                        <img class="p-1 text-center mx-auto bg-white"
                             src="{{ URL('images/Fluxo-ProjetoNovoAdmin.png') }}" alt="Fluxo Projeto Novo">
                    </div>
                    <div class="p-5">
                        <p class="text-center text-lg my-2 dark:text-white">
                            Diagrama de Fluxo para Adicionar um Utilizador a um Projeto Existente
                        </p>

                        <img class="p-1 text-center mx-auto bg-white"
                             src="{{ URL('images/Fluxo-ProjetoExistenteAdmin.png') }}" alt="Fluxo Projeto Existente">
                    </div>
                </div>
            </div>
            {{-- Other ?? --}}
        @else
            <div class="p-2 md:p-5 m-2 md:m-5 border border-esce rounded-md">
                @include('info-project')
            </div>
        @endif
    </div>
@endsection
