
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Solicitação nº {{$idSolicit}}</h3>

    <p>

        {{-- {{$hsAtual}} --}}
        @if ($hsAtual < 12)
            Bom dia,
        @elseif($hsAtual >= 12 && $hsAtual < 18)
            Boa tarde,
        @else
            Boa noite,
        @endif
    </p>
    <p>
        Solicito <b>RECARGA</b> de O2 para o(a) paciente abaixo.
    </p>
    <p>
        PCT: {{$namePct}}<br>
        End: {{$strEndPct}} - {{$cityPct}}<br>
        Contato: {{$celContatoPct}} ({{$respPct}})
        <br>
        <h3> • {{$equipRentSolicit}}</h3>
        
    </p>
        

    <p>Att.</p>
    <p>MH Suprimentos</p>

</body>
</html>

