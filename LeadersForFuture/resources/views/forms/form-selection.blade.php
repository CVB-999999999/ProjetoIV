@extends('layouts.app')
@section('content')

    <div class="w-full relative min-h-screen md:flex">

        <!-- content -->
        <div class="mx-auto dark:text-gray-200">

            @if( empty($forms))
                <div class="my-auto">
                    <h1> Não tem forms associados</h1>
                    <p> Por favor contacte o Professor responsavel pelos seus projetos para mais informação</p>
                </div>

            @else
                <h1 class="text-center text-3xl m-2 m-md-5"> Escolha um formulário</h1>

                @php($aux = "")
                @php($i=0)

                @foreach($forms as $form)

                    {{-- Verify if project title has been displayed --}}
                    @if(!($aux === $form->nome))
                        <h2 class="text-center text-xl my-5"> {{ $form->nome }} </h2>
                        @php($i=0)
                    @endif

                    @php($aux = $form->nome)
                    @php($i++)

                    {{-- card with link --}}
                    <a href="form/{{ $form->id }}"
                       class="block rounded m-2 m-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900
                   transition duration-200 hover:bg-esce hover:text-white">

                        <div class="md:grid md:grid-cols-2 p-1">
                            {{-- Left side - Number and year info --}}
                            <div class="mx-md-4">
                                <p> Formulario nº {{ $i }}</p>
                                <p> {{ $form->ano_curricular }}º ano - {{ $form->semestre + 1 }}º semestre</p>
                            </div>
                            {{-- Right side - Status --}}
                            <div class="text-right mx-md-4">
                                Estado:

                                @switch($form->estado)
                                    @case(0)
                                        Bloqueado
                                        @break
                                    @case(1)
                                        Aberto
                                        @break
                                    @case(2)
                                        Em avaliação
                                        @break
                                    @case(3)
                                        Concluido
                                        @break
                                    @default
                                        Desconhecido
                                @endswitch
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endsection
