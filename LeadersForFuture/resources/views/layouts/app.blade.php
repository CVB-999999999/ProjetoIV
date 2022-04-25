<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader for the Future</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @livewireStyles
    @powerGridStyles
</head>

<body class="flex flex-col h-screen justify-between bg-zinc-50 dark:bg-zinc-800">
<div class="bg-zinc-50 dark:bg-zinc-800 mb-auto">
    <div class="md:flex w-full">
        @include('livewire.sidebar')

        {{ $slot }}
    </div>

    @livewireScripts
    @powerGridScripts
</div>

{{-- This neeeds to be here to work proprelly.                                                          --}}
{{-- For some reason this goes one div up when logged in (eg: in this place it will go to line 24)      --}}
@include('layouts.footer')
</body>

</html>
