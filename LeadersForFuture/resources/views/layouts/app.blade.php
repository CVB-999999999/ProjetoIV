<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Leaders for the Future</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    @livewireStyles
    @powerGridStyles
</head>

<body class="flex flex-col h-screen justify-between bg-zinc-50 dark:bg-zinc-800">
@auth()
    @include('components.navbar')
@endauth

<div class="bg-zinc-50 dark:bg-zinc-800 mb-auto">
    <div class="md:flex w-full">

        @auth()
            @include('components.sidebar')
        @endauth

        @yield('content')
    </div>
</div>

@include('components.footer')

@livewireScripts
@powerGridScripts
@livewire('livewire-ui-modal')

</body>

</html>
