<form class="mb-0 space-y-6" wire:submit.prevent="login" method="POST">

    {{-- User input --}}
    <div>
        <label for="login" class="block text-sm font-medium text-gray-700">Email</label>
        <div class="mt-1">
            <input id="login" wire:model="username" type="text" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2
                   form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="login"
                   value="{{ old('username') }}" required>
        </div>
    </div>

    {{-- Password input --}}
    <div>
        <label for="password" class=" block text-sm font-medium text-gray-700">Password</label>
        <div class="mt-1">
            <input id="password" wire:model="password" class="border border-opacity-50 rounded border-gray-700 w-full
             py-1 px-2"
                   name="password" type="password" autocomplete="current-password"/>
        </div>
    </div>

    {{-- Password/Username wrong warning --}}
    @if (!$verifier)
        <div class="">
            <h1 class="font-semibold text-red-500"> A password ou o utilizador estão incorretos</h1>
        </div>
    @endif

    {{-- Remember me --}}
    <div class="form-group mb-3">
        <div class="checkbox">
            <label>
                <input wire:model="remember" type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    </div>

    {{-- Submit btn --}}
    <div>
        <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm font-medium
        text-white bg-zinc-600 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            Login
        </button>

        <div wire:loading.delay>
            A processar a operação no servidor...
        </div>
    </div>
</form>
