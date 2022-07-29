{{-- Professor --}}
@if(Auth::user()->id_tipoUtilizador == 1)
    <a href="/prof/stats"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">query_stats</span> Estatisticas
    </a>
    <a href="/prof/forms"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">add</span> Criar Formulário
    </a>
    <a href="/prof/proj"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Projetos Atribuidos
    </a>
    <a href="/prof/projUser"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Projetos Atribuidos por Aluno
    </a>
@endif
{{-- Student --}}
@if(Auth::user()->id_tipoUtilizador == 2)
    <a href="/form"
       class="block py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">article</span> Formulários
    </a>
@endif
{{-- Admin --}}
@if(Auth::user()->id_tipoUtilizador == 3)
    <a href="/admin/users"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">manage_accounts</span> Utilizadores
    </a>
    <a href="/admin/stats"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">query_stats</span> Estatisticas
    </a>
    <a href="/admin/forms"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Formulários
    </a>
    <a href="/admin/proj"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Projetos
    </a>
    <a href="/admin/projUser"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Projetos Atribuidos por Aluno
    </a>
    <a href="/admin/disc"
       class="block my-2 py-2.5 px-4 rounded transition duration-200 hover:bg-esce hover:text-white">
        <span class="material-symbols-outlined align-middle h-7">library_books</span> Disciplinas
    </a>
@endif
