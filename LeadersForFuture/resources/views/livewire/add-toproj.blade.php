<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        <div class="w-full">
            <div class="relative mx-auto dark:text-white">
                <div>
                <label for="tema" class="block font-medium"> Projeto </label>
                <select wire:model="projeto" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="projeto">
                        <option selected="projeto">Projeto</option>
                        @foreach($projetos as $projeto)
                            <option value="{{ $projeto->id }}">{{ $projeto->id }} - {{ $projeto->nome }}</option>
                        @endforeach
                    </select>
                    <label for="tema" class="block font-medium"> Utilizador </label>
                    <select wire:model="user" class="form-control p-3 rounded-md dark:bg-zinc-900 w-1/2 my-2"
                            name="user">
                        <option selected="user">Utilizador</option>
                        @foreach($users as $user)
                            <option value="{{ $user->numero }}">{{ $user->numero }} - {{ $user->username }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
                    Atribuir Utilizador a Projeto
                </button>
            </div>
        </div>
    </form>
</div>
