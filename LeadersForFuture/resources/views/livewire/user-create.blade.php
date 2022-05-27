<div>
    <form wire:submit.prevent="submitForm" method="POST" class="md:m-7 m-3">
        {{-- First Name --}}
        <label for="Fname" class="block font-medium"> Primeiro Nome </label>
        <input wire:model="firstN" name="Fname" type="text" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2 mb-3">

        {{-- Last Name --}}
        <label for="Lname" class="block font-medium"> Apelido </label>
        <input wire:model="lastN" name="Lname" type="text" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2 mb-3">

        {{-- Email --}}
        <label for="email" class="block font-medium"> Email </label>
        <input wire:model="emailA" name="email" type="email" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2 mb-3">

        {{-- Number --}}
        <label for="number" class="block font-medium"> Número Mecanografico </label>
        <input wire:model="mNumber" name="number" type="number" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2 mb-3">

        {{-- NIF --}}
        <label for="nif" class="block font-medium"> NIF </label>
        <input wire:model="nif" name="nif" type="number" class="border border-opacity-50 rounded border-gray-700
            w-full py-1 px-2 mb-3">

        {{-- Type --}}
        <label for="type" class="block font-medium"> Tipo de Utilizador </label>
        <select wire:model="typeA" name="type" class="border border-opacity-50 rounded border-gray-700
            w-full py-2 bg-white dark:text-black mb-3">
            <option value="1">Aluno</option>
            <option value="2">Professor</option>
            <option value="3">Admin</option>
        </select>

        <button class="bg-zinc-200 dark:bg-zinc-900 rounded hover:bg-esce hover:text-white px-4 py-2 my-2">
            Criar Utilizador
        </button>
    </form>
</div>
