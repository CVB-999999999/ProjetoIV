{{-- Professor --}}
@if(Session::get('tipo') == 1)
    {{-- Para já não vai ter nada aqui --}}
@endif
{{-- Student --}}
@if(Session::get('tipo') == 2)
    <a href="/form"
       class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        Formulários
    </a>
@endif
{{-- Admin --}}
@if(Session::get('tipo') == 3)
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
