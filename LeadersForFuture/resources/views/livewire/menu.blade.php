{{-- Semester and year selector --}}
<div class="w-full h-10 mx-auto">
    <div class="flex flex-col">
        <div class="w-full h-10">
            {{-- Professor --}}
            @if( Session::get('tipo') == 1)
                <div class="p-4 border-b border-gray-200 shadow ">
                    {{-- TODO: Make this table things dinamic | this top part will probably get removed?--}}
                    <div class="">
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
                {{-- PowerGrid table --}}
                <livewire:form-table semestre="{{ $semestre }}" anoLetivo="{{ $anoLetivo }}"/>
            @endif
            {{-- Student --}}
            @if( Session::get('tipo') == 2)
                {{-- Para já não vai ter nada aqui --}}
            @endif
        </div>
    </div>
</div>
