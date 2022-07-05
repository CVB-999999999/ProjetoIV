<html>
<head>

    @php
        $al = array();
        $prof = array();

        foreach ($dadosUsers as $d) {
            if ($d->id_tipoUtilizador == 2) {
                array_push($al, $d);
            } else {
                array_push($prof, $d);
            }
        }
    @endphp

    <style>
        .page-break {
            page-break-after: always;
        }

        div {
            word-wrap: break-word;
        }

        p {
            word-wrap: break-word;
        }

        h1 {
            word-wrap: break-word;
        }

        h2 {
            word-wrap: break-word;
        }

        h3 {
            word-wrap: break-word;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            /*height: 50px;*/
            line-height: 35px;
            padding-top: 1.5rem;
            border-bottom-style: solid;
            border-bottom-width: 1px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            /*height: 50px;*/
            line-height: 35px;
            padding-bottom: 1.5rem;
            border-top-style: solid;
            border-top-width: 1px;
        }

    </style>
</head>
<body>
{{-- Front Page --}}
{{-- IPVC IMG --}}
@php
    $path = 'https://www.ipvc.pt/wp-content/uploads/2020/11/logo_ipvc_svg.svg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<div>
    <img style="margin-left: 25%; max-width: 50%; margin-top: 5rem" src="{{$base64}}"/>
</div>

{{-- ESCE IMG --}}
@php
    $path = 'https://www.ipvc.pt/esce/wp-content/uploads/sites/5/2020/12/esce_logo_home.svg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
@endphp
<div>
    <img style="margin-left: 30%; max-width: 40%; margin-top: 10rem" src="{{$base64}}"/>
</div>

<div>
    <h3 style="margin-top: 5rem; text-align: center"> {{ $dadosCurso[0]->nm_curso }}</h3>
    <h3 style="margin-top: 5rem; text-align: center"> {{ $dadosCurso[0]->ds_discip }}</h3>
    <h3 style="text-align: center"> {{ $dadosForms[0]->tema }}</h3>

    <div style="text-align: left; position: fixed; bottom: 0; left: 0">
        @foreach($al as $a)
            <p> {{ $a->nome }} {{ $a->apelido }} - nº {{ $a->numero }}</p>
        @endforeach
    </div>

    <div style="text-align: right; position: fixed; bottom: 0; right: 0">
        <p>
            {{ $dadosForms[0]->ano_letivo }} - {{ $dadosForms[0]->ano_letivo+1 }}
        </p>

        <p> Supervisionado Por: </p>

        @foreach($prof as $a)
            <p> {{ $a->nome }} {{ $a->apelido }}</p>
        @endforeach
    </div>
</div>


<div class="page-break"></div>

<header>
    {{ $dadosForms[0]->ano_letivo }} - {{ $dadosForms[0]->ano_letivo+1 }} - {{ $dadosForms[0]->tema }}
</header>

<footer>
    @foreach($al as $a)
        {{ $a->nome }} {{ $a->apelido }} - nº {{ $a->numero }} |
    @endforeach

    <strong>Unidade Curricular: {{ $dadosCurso[0]->ds_discip }}</strong>
</footer>

{{-- Secção de Perguntas e Respostas--}}
@foreach ($perguntas as $index => $pergunta)
    <p><h3> {{ $index + 1}}) {{ $pergunta->pergunta }}</h3>
    <p>{{ trim($respostas[$index]->Resposta) }}</p>
    </p>

@endforeach
</body>
</html>
