<html>

<head>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.8.1/dist/cdn.min.js"></script>


    @livewireStyles
    @powerGridStyles
</head>
<body>
    <div class="flex w-full ">
        @include('livewire.sidebar')
        {{ $slot }}
    @livewireScripts
    @powerGridScripts
    </div>
    
</body>

</html>
