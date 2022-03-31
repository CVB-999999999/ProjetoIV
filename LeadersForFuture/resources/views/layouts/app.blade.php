<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader for the Future</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>

    @livewireStyles
    @powerGridStyles
</head>
<body>
    <div class="flex w-full bg-zinc-50 dark:bg-zinc-800">
        @include('livewire.sidebar')
        {{ $slot }}
    @livewireScripts
    @powerGridScripts
    </div>

</body>

</html>
