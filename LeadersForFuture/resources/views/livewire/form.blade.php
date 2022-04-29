<div class="relative mx-auto dark:text-white mb-3">
    <form wire:submit.prevent="submitForm" method="POST" class="md:mx-5">
        {{-- Header with student info --}}
        <div class="mx-2 m-md-3 dark:text-white" x-data="{ expanded: false }">
            <button type="button" class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900
                   transition duration-200 hover:bg-esce hover:text-white text-left" @click="expanded = ! expanded">
                Informação do Estudante
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

        {{-- Impossible to anwser || Ready to anwser and Teacher || Anwsered and Student || Form Locked --}}
        @if (($estado[0]->estado == 0) || ($estado[0]->estado ==1 && $prof) || ($estado[0]->estado == 2 && $aluno) || ($estado[0]->estado == 3))
            @foreach ($perguntas as $index => $pergunta)
                <div class="mx-2 mx-md-3" x-data="{ expanded: false }">
                    <button type="button" class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                       transition duration-200 hover:bg-esce hover:text-white text-left"
                            @click="expanded = ! expanded">
                        <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                    </button>
                    <p x-show="expanded" x-collapse>

                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full rounded-md"
                                          rows="6"
                                          disabled>
                                </textarea>
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
                        <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                    </button>

                    {{-- Text Area --}}
                    <p x-show="expanded" x-collapse>
                        {{-- Teacher observation field (disabled for the student) --}}
                        @if ($loop->last)
                            {{--                                    <textarea name="ta{{ $index }}"--}}
                            {{--                                              class="border border-gray-500 p-2 rounded-md w-full dark:bg-zinc-900"--}}
                            {{--                                              rows="6" disabled></textarea>--}}
                            {{-- Campos dos estudantes --}}
                        @else
                            <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                      class="border border-black p-2 w-full  rounded-md dark:bg-zinc-900"
                                      rows="6"></textarea>
                        @endif
                        <button wire:click.prevent="save({{ $index }})"
                                class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                            Guardar
                        </button>
                    </p>
                </div>
            @endforeach

            {{-- Anwsered and Teacher --}}
        @elseif ($estado[0]->estado == 2 && $prof)

            @foreach ($perguntas as $index => $pergunta)
                <div class="mx-2 m-md-3" x-data="{ expanded: false }">

                    <button type="button" class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                            transition duration-200 hover:bg-esce hover:text-white text-left"
                            @click="expanded = ! expanded">
                        <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                    </button>

                    <p x-show="expanded" x-collapse>
                        @if ($loop->last)
                            {{--                                    <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"--}}
                            {{--                                              class="border border-black p-2 w-full rounded-md" rows="6"></textarea>--}}
                        @else
                            <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full rounded-md"
                                      rows="6" disabled></textarea>
                        @endif
                    </p>
                </div>
            @endforeach
        @endif

        {{-- Teacher Observations --}}
        <div class="mx-2 mx-md-3" x-data="{ expanded: false }">
            <button type="button" class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                       transition duration-200 hover:bg-esce hover:text-white text-left"
                    @click="expanded = ! expanded">
                <label for="obs">Observações do Docente </label>
            </button>
            <p x-show="expanded" x-collapse>
                {{-- Aqui fica uma powergrid para mostrar o historico --}}
                <span> Power Grid Placeholder</span>
                {{-- Parte do docente --}}
                <textarea name="obs" class="border border-black p-2 w-full rounded-md dark:bg-zinc-900"
                          rows="6">
                </textarea>
                {{-- Btn para guardar --}}
            </p>
        </div>

        @if($estado[0]->estado == 1 && $aluno|| $estado[0]->estado == 2 && $prof)
            <div class="flex justify-center md:justify-end">
                <button type="submit" x-data x-on:click.document="window.scrollTo(0, 0)"
                        class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                    Submeter para avaliação
                </button>

                {{-- Loading popup --}}
                <div wire:loading.delay>
                    @include('modals.loading')
                </div>
            </div>
        @endif
    </form>
</div>

