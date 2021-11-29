
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Solicitação nº {{$idSolicit}} Concluída</h3>

    <p>Informamos que na data de hoje foi realizado <b> {{$typeSolicitFim}} </b> do(s) seguinte(s) equipamento(s)<br>
        para o(a) paciente {{$namePct}} conforme guia em anexo.<br>
            {{-- {{$equipsSolicFimEmail}} --}}
            @foreach ($equipsSolicFim as $equip)
                <li>
                    {{$equip}}
                </li>
            @endforeach

    </p>
    @if ($obsAtendfim != null)
        <i>Obs: {{$obsAtendfim}}</i>
    @endif
    <p>Att.</p>
    <p>MH Suprimentos</p>
</body>
</html>

