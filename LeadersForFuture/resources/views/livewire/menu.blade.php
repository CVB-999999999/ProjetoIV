<div class="w-full bg-white">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="relative min-h-screen md:flex">

        <!-- mobile menu bar -->

        <!-- content -->
        <div class="w-full h-10 mx-auto my-20">
            <div class="flex flex-col">
                <div class="w-full h-10">
                    <div class="p-4 border-b border-gray-200 shadow ">
                        <!-- <table> -->
                        <div class="flex justify-around">
                            <label for="Semestre">Semestre</label>
                            <select wire:model="semestre" name="Semestre" id="Semestre">
                                <option value="1" selected>1º Semestre</option>
                                <option value="2">2º Semetres</option>
                            </select>

                            <label for="AnoLetivo">Ano Letivo</label>
                            <select wire:model="anoLetivo" name="AnoLetivo" id="AnoLetivo">
                                <option value="2021" selected>2021/2022</option>
                                <option value="2020">2020/2021</option>
                                <option value="2019">2019/2020</option>
                                <option value="2018">2018/2019</option>
                            </select>
                        </div>

                        


                    </div>
                    
                </div>
                <livewire:form-table semestre="{{ $semestre }}" anoLetivo="{{ $anoLetivo }}"/>

            </div>
        </div>

    </div>
    

</div>
