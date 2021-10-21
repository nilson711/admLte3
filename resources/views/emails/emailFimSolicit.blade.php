
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Solicitação nº {{$idsolfimEmail}} Concluída</h3>
    <h3>PCT:
        @foreach ($pctSolFimEmail as $pct)
            {{$pct}}
        @endforeach
    </h3>
    <p>Informamos que na data de hoje foi realizado IMPLANTAÇÃO do(s) seguinte(s) equipamento(s):<br>

    </p>
    <p>Obs: {{$obsAtendfimEmail}}</p><br>
    <p>conforme guia em anexo.</p><br>
    <p>Att.</p>
    <p>MH Suprimentos</p>
</body>
</html>

