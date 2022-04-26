<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

<div class="w-full">
    {{-- Form --}}
    <div class="relative mx-auto dark:text-white mb-3">
        <div class="md:mx-5">
            {{-- Header with student info --}}
            <div class="mx-2 m-md-3 dark:text-white" x-data="{ expanded: false }">
                <button class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900
                   transition duration-200 hover:bg-esce hover:text-white text-left" @click="expanded = ! expanded">
                    Informação do Estudante
                </button>

                <p x-show="expanded" x-collapse.duration.600ms>

                    {{-- Student Data --}}
                    @foreach($dadosUsers as $dados)
                        {{-- Name --}}
                        <span class="my-3 flex justify-start mx-8">
                            {{-- Professor --}}
                            @if($dados->id_tipoUtilizador == 1)
                                Professor:
                            @else
                                Nome:
                            @endif
                            {{ $dados->nome }} {{ $dados->apelido }}
                        </span>
                        <span class="my-3 grid grid-cols-3 mx-8">
                            {{-- Student Number --}}
                            <span class="flex justify-start ">
                                Nº de aluno: {{ $dados->numero }}
                            </span>
                            {{-- Email --}}
                            <span class="flex col-span-2 mx-8">
                                Email: {{ $dados->email }}
                            </span>
                        </span>

                    <hr class="border dark:border-zinc-700">
                    @endforeach

                    @foreach($dadosForm as $form)
                        {{-- Course Data --}}
                        <span class="my-3 grid grid-cols-2 mx-8">
                            {{-- Course --}}
                            <span class="flex justify-start">
                                Curso: Curso
                            </span>
                            {{-- Year --}}
                            <span class="flex justify-start">
                                {{ $form->ano_curricular }}ºano &nbsp; {{ $form->semestre }}º semestre
                            </span>
                        </span>

                        {{-- Task --}}
                        <span class="my-3 grid grid-cols-1 mx-8">
                            <span class="flex justify-start">
                                Tema: {{ $form->tema }}
                            </span>
                        </span>

                        {{-- School Year --}}
                        <span class="my-3 grid grid-cols-1 grid-rows-1 mx-8">
                            <span class=" flex justify-between">
                                Ano Letivo: {{ $form->ano_letivo }}
                            </span>
                        </span>
                    @endforeach
                </p>
            </div>

            {{-- Impossible to anwser || Ready to anwser and Teacher || Anwsered and Student || Form Locked --}}
            @if (($estado[0]->estado == 0) || ($estado[0]->estado ==1 && $prof) || ($estado[0]->estado == 2 && $aluno) || ($estado[0]->estado == 3))
                @foreach ($perguntas as $index => $pergunta)
                    <div class="mx-2 mx-md-3" x-data="{ expanded: false }">
                        <button class="w-full rounded mt-2 mt-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                       transition duration-200 hover:bg-esce hover:text-white text-left"
                                @click="expanded = ! expanded">
                            <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                        </button>
                        <p x-show="expanded" x-collapse>

                        <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full rounded-md" rows="6"
                                  disabled>
                            </textarea>
                        </p>
                    </div>
                @endforeach

                {{-- Ready to anwser and Student --}}
            @elseif ($estado[0]->estado == 1 && $aluno)
                @foreach ($perguntas as $index => $pergunta)
                    <div class="mx-2 m-md-3" x-data="{ expanded: false }">

                        <button class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                            transition duration-200 hover:bg-esce hover:text-white text-left"
                                @click="expanded = ! expanded">
                            <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                        </button>

                        {{-- Text Area --}}
                        <p x-show="expanded" x-collapse>
                            {{-- Teacher observation field (disabled for the student) --}}
                            @if ($loop->last)
                                <textarea name="ta{{ $index }}"
                                          class="border border-gray-500 p-2 rounded-md w-full dark:bg-zinc-900"
                                          rows="6" disabled></textarea>
                                {{-- Campos dos estudantes --}}
                            @else
                                <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                          class="border border-black p-2 w-full  rounded-md dark:bg-zinc-900"
                                          rows="6"></textarea>
                            @endif
                        </p>
                    </div>
                @endforeach

                {{-- Anwsered and Teacher --}}
            @elseif ($estado[0]->estado == 2 && $prof)

                @foreach ($perguntas as $index => $pergunta)
                    <div class="mx-2 m-md-3" x-data="{ expanded: false }">

                        <button class="w-full rounded my-2 my-md-4 py-2.5 px-4 bg-zinc-200 dark:bg-zinc-900 dark:text-white
                            transition duration-200 hover:bg-esce hover:text-white text-left"
                                @click="expanded = ! expanded">
                            <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                        </button>

                        <p x-show="expanded" x-collapse>
                            @if ($loop->last)
                                <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                          class="border border-black p-2 w-full rounded-md" rows="6"></textarea>
                            @else
                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full rounded-md"
                                          rows="6" disabled></textarea>
                            @endif
                        </p>
                    </div>
                @endforeach
            @endif

            @if($estado[0]->estado == 1 && $aluno|| $estado[0]->estado == 2 && $prof)
                <div class="flex justify-center md:justify-end">
                    <button wire:click.prevent="submit"
                            class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                        Guardar
                    </button>
                    <button wire:click.prevent="submit"
                            class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 m-2">
                        Submeter
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
