<div class="relative mx-auto dark:text-white mb-3">
    <form wire:submit.prevent="submitForm" method="POST" class="md:mx-5 mb-10">
        {{-- Form Status --}}
        <div class="md:grid md:grid-cols-2">
            <div class="mx-2 my-2">
                <a href="/downloadpdf/{{$formID}}"
                   class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2">
                    <span class="material-symbols-outlined align-middle h-7">file_download</span>
                    Download PDF</a>
                <div wire:loading.delay>
                    A carregar...
                </div>
            </div>

            <div class="mx-2 my-2 md:text-right"> Estado do Formulário:
                @switch($estado[0]->estado)
                    @case(0)
                        <span class="text-orange-500">
                            <span class="material-symbols-outlined align-middle h-7">lock</span>
                            Bloqueado
                        </span>
                        @break
                    @case(1)
                        <span class="text-green-600">
                            <span class="material-symbols-outlined align-middle h-7">lock_open</span>
                            Aberto
                        </span>
                        @break
                    @case(2)
                        <span class="text-purple-800 dark:text-purple-400">
                            <span class="material-symbols-outlined align-middle h-7">history_edu</span>
                            Em avaliação
                        </span>
                        @break
                    @case(3)
                        <span class="text-cyan-600">
                            <span class="material-symbols-outlined align-middle h-7">check_small</span>
                            Terminado
                        </span>
                        @break
                    @default
                        <span class="material-symbols-outlined align-middle h-7">question_mark</span>
                        Desconhecido
                @endswitch
            </div>
        </div>

        {{-- Header with student info --}}
        <div class="mx-2 m-md-3 dark:text-white" x-data="{ expanded: false }">
            <button type="button" class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900
                   transition duration-200 hover:bg-esce hover:text-white text-left" @click="expanded = ! expanded">
                <span class="material-symbols-outlined align-middle h-7">info</span> &emsp;Informação do Formulário
            </button>

            <p x-show="expanded" x-collapse.duration.600ms>

                {{-- Student Data --}}
                @foreach($dadosUsers as $dados)
                    {{-- Name --}}
                    <span class="m-2.5 md:m-3">
                            {{-- Professor --}}
                        @if($dados->id_tipoUtilizador == 1)
                            Professor:
                        @else
                            Nome:
                        @endif
                        {{ $dados->nome }} {{ $dados->apelido }}
                            </span>
                    <span class="m-2.5 md:m-3 grid grid-cols-3 border-b-2 pb-2 md:pb-1 border-zinc-700">
                            {{-- Student Number --}}
                            <span class="col-span-3 md:col-span-1 mb-2.5 md:mb-3">
                                Número Mecanografico: {{ $dados->numero }}
                            </span>
                            {{-- Email --}}
                            <span class="col-span-3 md:col-span-2">
                                Email: {{ $dados->email }}
                            </span>
                        </span>
                @endforeach

                {{-- Course Data --}}
                <span class="grid grid-cols-1 md:grid-cols-2 m-2.5 md:m-3 md:pt-1">

                        @if(!empty($dadosCurso))
                        {{-- Course --}}
                        <span>
                                Curso: {{ $dadosCurso[0]->nm_curso }}
                            </span>
                        <span class="mt-2.5 md:mt-0">
                                Grau: {{ $dadosCurso[0]->ds_grau }}
                            </span>
                        <span class="mt-2.5 md:mt-3">
                                Disciplina: {{ $dadosCurso[0]->ds_discip }}
                            </span>
                    @endif

                    @foreach($dadosForm as $form)
                        {{-- Year --}}
                        <span class="mt-2.5 md:mt-3">
                                {{ $form->ano_curricular }}ºano &nbsp; {{ $form->semestre }}º semestre
                            </span>

                        {{-- Task --}}
                        <span class="mt-2.5 md:mt-3">
                                Tema: {{ $form->tema }}
                            </span>

                        {{-- School Year --}}
                        <span class="mt-2.5 md:mt-3">
                                Ano Letivo: {{ $form->ano_letivo }}
                            </span>
                    @endforeach
                    </span>
            </p>
        </div>

        {{-- No Questions --}}
        @php
            if(sizeof($perguntas) < 1) {
                echo('<p class="text-3xl text-center my-5">Não tem Perguntas neste Formulário</p>');
            }
        @endphp

        {{-- Impossible to anwser || Ready to anwser and Teacher || Anwsered || Form Locked --}}
        @if (($estado[0]->estado == 0) || ($estado[0]->estado ==1 && $prof) || ($estado[0]->estado == 2) || ($estado[0]->estado == 3) || Auth::user()->id_tipoUtilizador == 3)
            @foreach ($perguntas as $index => $pergunta)
                <div class="mx-2 mx-md-3" x-data="{ expanded: false }">
                    <button type="button" class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                       transition duration-200 hover:bg-esce hover:text-white text-left"
                            @click="expanded = ! expanded">
                        <label for="ta{{ $index }}">{{ $index + 1}} &nbsp; | &emsp; {{ $pergunta->pergunta }} </label>
                    </button>
                    {{-- Text Area Placeholder --}}
                    <p x-show="expanded" x-collapse>
                        <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                  class="border border-gray-500 p-2 w-full rounded-md" rows="6" disabled></textarea>
                    </p>
                </div>
            @endforeach

            {{-- Ready to anwser and Student --}}
        @elseif ($estado[0]->estado == 1 && $aluno)
            @foreach ($perguntas as $index => $pergunta)
                <div class="mx-2 m-md-3" x-data="{ expanded: false }">

                    <button type="button" class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                            transition duration-200 hover:bg-esce hover:text-white text-left"
                            @click="expanded = ! expanded">
                        <label for="ta{{ $index }}">{{ $index + 1}} &nbsp; | &emsp; {{ $pergunta->pergunta }} </label>
                    </button>

                    <p x-show="expanded" x-collapse>
                        {{-- Text Area --}}
                        <textarea wire:model='respostas.{{ $index }}' name="ta{{ $index }}"
                                  class="border border-black p-2 w-full rounded-md dark:bg-zinc-900"
                                  rows="6"></textarea>
                        {{-- Submit Btn --}}
                        <button wire:click.prevent="save({{ $index }})"
                                class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                            <span class="material-symbols-outlined align-middle h-7">save</span> Guardar
                        </button>
                    </p>
                </div>
            @endforeach
        @endif

        {{-- Teacher Observations --}}
        @if($estado[0]->estado == 2 && $prof)
            <div class="mx-2 mx-md-3" x-data="{ expanded: false }">
                <button type="button" class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                       transition duration-200 hover:bg-esce hover:text-white text-left"
                        @click="expanded = ! expanded">
                    <label for="obs">
                        <span class="material-symbols-outlined align-middle h-7">school</span>
                        &emsp; Observações do Docente
                    </label>
                </button>
                <p x-show="expanded" x-collapse>
                    @if($estado[0]->estado == 2 && $prof)
                        <textarea wire:model="obs" name="obs" rows="6"
                                  class="border border-black p-2 w-full rounded-md dark:bg-zinc-900"></textarea>
                        <label for="state" class="ml-1"> Estado do Formulário</label>
                        <select wire:model="apr" id="state" name="state" class="form-select appearance-none block w-full px-3 py-1.5
                                bg-clip-padding bg-no-repeat rounded transition bg-zinc-200 dark:bg-zinc-900 dark:text-white
                                ease-in-out m-0 focus:outline-none" required>
                            <option selected>Escolha uma opção</option>
                            <option value="true">
                                Aprovado
                            </option>
                            <option value="false">
                                Não Aprovado
                            </option>
                        </select>
                    @endif
                </p>
            </div>
        @endif

        {{-- Submit Button --}}
        @if(($estado[0]->estado == 1 && $aluno) || ($estado[0]->estado == 2 && $prof))
            <div class="flex justify-center md:justify-end">
                <button type="submit" x-data x-on:click.button="window.scrollTo(0, 0)"
                        class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                    @if($prof)
                        <span class="material-symbols-outlined align-middle h-7">publish</span>
                        Submeter Observação
                    @elseif($aluno)
                        <span class="material-symbols-outlined align-middle h-7">publish</span>
                        Submeter para Avaliação
                    @endif
                </button>

                {{--                --}}{{-- Loading popup --}}
                {{--                <div wire:loading.delay>--}}
                {{--                    @include('modals.loading')--}}
                {{--                </div>--}}
            </div>
        @endif
    </form>

    {{-- Table With the Observation History --}}
    <div class="mx-2 md:mx-7">
        <p class="text-2xl"> Observações do Docente</p>
        <livewire:obs-table formID="{{ $formID }}"/>
    </div>
</div>

<script>
    window.addEventListener('noPermission', error => {
        alert(error.detail.error);
    })
</script>
