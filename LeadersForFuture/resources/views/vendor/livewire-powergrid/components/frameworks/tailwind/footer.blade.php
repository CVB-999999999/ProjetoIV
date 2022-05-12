<div
    class="md:flex md:flex-row w-full justify-between items-center pt-3 bg-white overflow-y-auto pl-2 pr-2 pb-1 relative dark:bg-zinc-900">

    @if($perPageInput)
        <div class="flex flex-row justify-center md:justify-start mb-2 md:mb-0">
            <div class="relative h-10">

                <select wire:model.lazy="perPage"
                        class="block appearance-none bg-zinc-50 border border-zinc-300 text-zinc-700 py-2 px-3 pr-8
                            rounded leading-tight focus:outline-none focus:bg-white focus:border-zinc-500 focus:dark:bg-esce
                            dark:bg-zinc-800 dark:text-zinc-200 dark:placeholder-zinc-200 dark:border-zinc-900">
                    @foreach($perPageValues as $value)
                        <option value="{{$value}}">
                            @if($value == 0)
                                {{ trans('livewire-powergrid::datatable.labels.all') }}
                            @else
                                {{ $value }}
                            @endif
                        </option>
                    @endforeach
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-zinc-700">
                    <x-livewire-powergrid::icons.down class="w-4 h-4"/>
                </div>
            </div>
            <div class="pl-4 hidden sm:block md:block lg:block w-full" style="padding-top: 6px;">
            </div>
        </div>
    @endif

    @if(filled($data))
        <div>
            @if(method_exists($data, 'links'))
                {!! $data->links(powerGridThemeRoot().'.pagination', ['recordCount' => $recordCount]) !!}
            @endif
        </div>
    @endif
</div>
