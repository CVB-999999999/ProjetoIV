

<div class="min-h-screen w-full bg-white flex flex-col justify-center py-12 px-6 lg:px-8">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-32 w-auto"
        src="{{ URL('images/estg.jpeg') }}" />
        <h1 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Login</h1>

    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-gray-100 py-8 px-6 shadow rounded-lg sm:px-10">
            <form class="mb-0 space-y-6" wire:submit.prevent="login"  method="POST" >

                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">Utilizador</label>
                    <div class="mt-1">
                        <input id="login" wire:model ="username" type="text"
                            class="border border-opacity-50 rounded border-gray-700 w-full form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                        name="login" value="{{ old('username') }}" required autofocus>


                    </div>
                </div>

                <div>
                    <label for="password" class=" block text-sm font-medium text-gray-700">Password</label>
                    <div class="mt-1">
                        <input id="password" wire:model = "password" class="border border-opacity-50 rounded border-gray-700 w-full" name="password" type="password"
                            autocomplete="current-password"  />

                    </div>
                </div>


                @if (!$verifier)
                <div class="">
                    <h1 class=" font-semibold text-red-500"> A password utilizada está errada</h1>
                </div>
                @endif



                <div class="flex items-center">
                    <input id="terms-and-privacy" name="terms-and-privacy" type="checkbox" class="" />
                    <label for="terms-and-privacy" class="ml-2 block text-sm text-gray-900">Lembrar username</label>
                </div>
                <div class="form-group mb-3">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white
                        bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" wire:click.prevent="login">Login
                    </button>
                 </div>
            </form>

        </div>
    </div>
</div>
