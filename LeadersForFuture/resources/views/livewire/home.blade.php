<div class="mx-auto container">

    {{-- Title --}}
    <div class="p-7 mt-10">
        <h1 class="text-center text-5xl md:text-8xl dark:text-gray-400">Leaders For the Future</h1>
    </div>

    {{-- Middle Card Login --}}
    <div class="md:grid grid-cols-8 mx-auto align-items-center">
        <div class="col-start-3 col-span-4 bg-zinc-100 p-2 md:p-8 rounded-md">
            <div class="md:grid grid-cols-2 mx-auto align-items-center">
                <div class="">
                    {{-- Logo --}}
                    <img class="p-1 md:pt-10 md:px-5" src="{{ URL('images/esce.png') }}" alt="ESCE Logo">
                    {{-- ^^^^^^^^^^^^ Melhorar o posicionamento da imagem que está muito mau assim ^^^^^^^^^^^^ --}}
                </div>
                {{-- Form --}}
                <div class="md:border-l-2 md:pl-5" style="border-color: #e92739">
                    <form class="mb-0 space-y-6" wire:submit.prevent="login" method="POST">

                        {{-- User input --}}
                        <div>
                            <label for="login" class="block text-sm font-medium text-gray-700">Utilizador</label>
                            <div class="mt-1">
                                <input id="login" wire:model="username" type="text"
                                       class="border border-opacity-50 rounded border-gray-700 w-full form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                                       name="login" value="{{ old('username') }}" required autofocus>
                            </div>
                        </div>

                        {{-- Password input --}}
                        <div>
                            <label for="password" class=" block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="password" wire:model="password"
                                       class="border border-opacity-50 rounded border-gray-700 w-full" name="password"
                                       type="password"
                                       autocomplete="current-password"/>

                            </div>
                        </div>

                        {{-- Password/Username wrong warning --}}
                        @if (!$verifier)
                            <div class="">
                                <h1 class=" font-semibold text-red-500"> A password utilizada está errada</h1>
                            </div>
                        @endif

                        {{-- Remember me --}}
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Remember Me
                                </label>
                            </div>
                        </div>

                        {{-- Submit btn --}}
                        <div>
                            <button type="submit"
                                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm font-medium text-white
                                        bg-zinc-600 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    wire:click.prevent="login">Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
