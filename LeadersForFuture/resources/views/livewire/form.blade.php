<div class="w-full">

    {{-- TODO: Redo this btn --}}
    <button wire:click.prevent="submit"
            class="bg-green-500 w-20 absolute top-0 right-0 m-10 border rounded border-black hover:bg-green-800">
        Submeter
    </button>

    {{-- Form --}}
    <div class="relative mx-auto ">
        <section class="mx-auto">
            <div class="mx-auto py-16 bg-white ">
                {{-- Header with student info --}}
                <div class="my-3 flex flex-row flex-wrap justify-start mx-8">
                    <p class="">ESCOLA SUPERIOR DE CIÊNCIAS EMPRESARIAIS</p>
                </div>

                {{-- Name --}}
                <div class="my-3 border-b border-black flex justify-start mx-8">
                    <p class="">Nome: {{ $name }}</p>
                </div>

                <div class="my-3 grid grid-cols-3 mx-8">
                    {{-- Student Number --}}
                    <div class="flex justify-start ">
                        <p class="">Nº de aluno: {{ $number }}</p>
                    </div>
                    {{-- Email --}}
                    <div class="flex col-span-2 mx-8">
                        <p class="">Email: {{ $email }}</p>
                    </div>
                </div>

                <div class="my-3 grid grid-cols-2 mx-8">
                    {{-- Course --}}
                    <div class="flex justify-start">
                        <p class="">Curso: {{ $course }}</p>
                    </div>
                    {{-- Year --}}
                    <div class="flex justify-start">
                        <p class="">Ano: {{ $year }}</p>
                    </div>
                </div>

                {{-- Task --}}
                <div class="my-3 grid grid-cols-1 mx-8">
                    <div class="flex justify-start">
                        <p class="">Tarefa realizada na Unidade Curricular: {{ $task }}</p>
                    </div>
                </div>

                {{-- School Year --}}
                <div class="my-3 grid grid-cols-1 grid-rows-1 mx-8">
                    <div class=" flex justify-between">
                        <p class="">Ano Letivo: {{ $schoolYear }}</p>
                    </div>
                </div>

                {{-- Impossible to anwser and Student --}}
                @if ($estado[0]->estado == 0 && $aluno)
                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                            <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="3" disabled>
                            </textarea>
                        </div>
                    @endforeach

                    {{-- Ready to anwser and Student --}}
                @elseif ($estado[0]->estado == 1 && $aluno)

                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            {{-- Teacher observation field (disabled for the student) --}}
                            @if ($loop->last)
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="3"
                                          disabled>
                                </textarea>
                                {{-- Campos dos estudantes --}}
                            @else
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                          class="border border-black p-2 w-full" rows="3"> </textarea>
                            @endif
                        </div>
                    @endforeach

                    {{-- Ready to anwser and Teacher --}}
                @elseif ($estado[0]->estado ==1 && $prof)
                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                            <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="1"
                                      disabled>
                                </textarea>
                        </div>
                    @endforeach

                    {{-- Anwsered and Teacher --}}
                @elseif ($estado[0]->estado == 2 && $prof)

                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            @if ($loop->last)
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea wire:model="respostas.{{ $index }}" name="ta{{ $index }}"
                                          class="border border-black p-2 w-full" rows="3"> </textarea>
                            @else
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="1"
                                          disabled>
                                </textarea>
                            @endif
                        </div>
                    @endforeach

                    {{-- Anwsered and Student --}}
                @elseif ($estado[0]->estado == 2 && $aluno)

                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            @if ($loop->last)
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="1"
                                          disabled>
                                </textarea>
                            @else
                                <label for="ta{{ $index }}">{{ $pergunta->pergunta }} </label>
                                <textarea name="ta{{ $index }}" class="border border-gray-500 p-2 w-full" rows="1"
                                          disabled>
                                    {{ $respostas[$index]->Resposta }}
                                </textarea>
                            @endif
                        </div>
                    @endforeach

                    {{-- Teacher anwsered and Teacher --}}
                @elseif($estado[0]->estado == 3 && $prof)

                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">

                            <p class="">{{ $pergunta->pergunta }} </p>

                            <p class="border border-black w-full "
                               rows="3">{{ $respostas[$index]->Resposta }}
                            </p>
                        </div>
                    @endforeach

                    {{-- Teacher anwsered and Teacher --}}{{-- Suposed to be student??? --}}
                @elseif ($estado[0]->estado == 3 && $prof)

                    @foreach ($perguntas as $index => $pergunta)
                        <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                            @if ($loop->last)
                                <p class="">{{ $pergunta->pergunta }} </p>

                                <p class="border border-black w-full "
                                   rows="3">{{ $respostas[$index]->Resposta }} </p>
                            @else
                                <p class="">{{ $pergunta->pergunta }} </p>

                                <textarea wire:model="respostas.{{ $index }}"
                                          class="border border-black w-full "
                                          rows="3"> </textarea>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
</div>
