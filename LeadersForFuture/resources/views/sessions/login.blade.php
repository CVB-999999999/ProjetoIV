@extends('layouts.app')
@section('content')

    <div class="mx-auto container">

        {{-- Title --}}
        <div class="p-7 mt-3 md:mt-10">
            <h1 class="text-center text-5xl md:text-8xl dark:text-gray-400">Leaders For the Future</h1>
        </div>

        {{-- Middle Card Login --}}
        <div class="md:grid grid-cols-8 mx-auto align-items-center">
            <div class="col-start-3 col-span-4 bg-zinc-100 p-2 md:p-8 rounded-md">
                <div class="md:grid grid-cols-2 mx-auto align-items-center">
                    <div class="">
                        {{-- Logo --}}
                        <img class="p-1 md:pt-10 md:px-5" src="{{ URL('images/esce.png') }}" alt="ESCE Logo">
                        {{-- TODO ^^^^^^^^^ Melhorar o posicionamento da imagem que está muito mau assim ^^^^^^^^^^ --}}
                    </div>
                    {{-- Form --}}
                    <div class="md:border-l-2 md:pl-5 border-esce">
                        @livewire('login')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
