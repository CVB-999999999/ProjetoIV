<div class="w-full bg-gray-400 ">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="relative mx-auto min-h-screen ">

      
        <!-- content -->
        <section class=" py-10 mx-auto">
            <div class="mx-auto py-16 bg-white ">
                <div class="my-3 flex flex-row flex-wrap justify-start mx-8">
                    <p class="">ESCOLA SUPERIOR DE CIÊNCIAS EMPRESARIAIS</p>
                </div>
    
                <div class="my-3 border-b border-black flex justify-start mx-8">
                    <p class="">Nome:</p>
                    
                    <input class="w-full" type="text">
                </div>
    
                <div class="my-3 grid grid-cols-3 mx-8">
                    <div class="flex justify-start ">
                        <p class="">Nº de aluno:</p>
    
                        <input class="w-4/6" type="text">
                    </div>
                    
    
                    <div class="flex col-span-2 mx-8">
                        <p class="">email: </p>
                        <input class="w-full" type="text">
                    </div>
                    
    
                </div>
    
                <div class="my-3 grid grid-cols-2 mx-8">
                    <div class="flex justify-start">
                        <p class="">Curso: </p>
    
                        <input class="w-full" type="text">
                    </div>
    
                    <div class="flex justify-start">
                        <p class="">Ano: </p>
    
                        <input class="w-full" type="text">
                    </div>               
                </div>    
    
                <div class="my-3 grid grid-cols-1 mx-8">
                    <div class="flex justify-start">
                        <p class="">Tarefa realizada na Unidade Curricular: </p>
    
                        <input class="w-8/12" type="text">
                    </div>
                    
                </div>
    
                <div class="my-3 grid grid-cols-1 grid-rows-1 mx-8">
                    <div class=" flex justify-between">
                        <p class="">Ano Letivo: </p>
                        <input class="w-11/12" type="text">
                    </div>


                 
                </div>
    
                @foreach ($perguntas as $index => $pergunta)
                    
                <div class="my-3 flex flex-row flex-wrap justify-between mx-8">
                    <p class="">{{ $pergunta->pergunta }} </p>
    
                    <textarea  class="border border-black w-full " rows="3" > </textarea>
                </div>
                                        
                @endforeach  
    
            </div>
        </section>
      
      </div>
    
</div>
