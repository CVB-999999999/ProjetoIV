{{-- Professor --}}
@if(Auth::user()->id_tipoUtilizador == 1)
{{--     Para já não vai ter nada aqui--}}
@endif
{{-- Student --}}
@if(Auth::user()->id_tipoUtilizador == 2)
    <a href="/form"
       class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        Formulários
    </a>
@endif
{{-- Admin --}}
@if(Auth::user()->id_tipoUtilizador == 3)
    <a href="/admin/users/create"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        Criar Utilizadores
    </a>
    <a href="/admin/users"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        Gerir Utilizadores
    </a>
    <a href="/admin/stats"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        Estatisticas
    </a>
@endif
