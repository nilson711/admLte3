
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

    <p>Informamos que na data de hoje foi realizado
        {{-- @switch($typeSolicitFim)
            @case(1)
              <b> IMPLANTAÇÃO </b>
            @break
            @case(2)
               <b> RECOLHIMENTO </b>
            @break
            @case(3)
               <b> TROCA / MANUTENÇÃO </b>
            @break
            @case(4)
              <b> MUDANÇA DE LOCALIDADE </b>
            @break
            @case(5)
              <b> RECOLHIMENTO TOTAL </b>
            @break
            @case(6)
                <b> CILINDRO DE O2 </b>
            @break

            @default

        @endswitch --}}

        <b>
            {{$typeSolicitFim}}
        </b>

        do(s) seguinte(s) equipamento(s)<br>
        para o(a) paciente
        @foreach ($pctSolFimEmail as $pct)
            <strong>
                {{$pct}},
            </strong>
        @endforeach
            conforme guia em anexo.<br>
            {{-- {{$equipsSolicFimEmail}} --}}
            @foreach ($equipsSolicFimEmail as $equip)
                <li>
                    {{$equip}}
                </li>

            @endforeach

    </p>
    @if ($obsAtendfimEmail != null)
        <i>Obs: {{$obsAtendfimEmail}}</i>
    @endif
    <p>Att.</p>
    <p>MH Suprimentos</p>
</body>
</html>

