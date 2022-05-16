
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
    <h3>IMPLANTAÇÃO</h3>

    <p>Informamos que na data de hoje foi realizado <b> {{$typeSolicitFim}} </b> do(s) seguinte(s) equipamento(s)<br>
        para o(a) paciente {{$namePct}}.<br>

        <table border="1" style="border-collapse: collapse">
            <tr>
                <th>Patr nº</th>
                <th>Equipamento</th>
            </tr>
            @foreach ($equipRentSolicit as $equip)
            <tr>
                <td>{{$equip->patr}}</td>
                <td>{{$equip->name_equip}}</td>
            </tr>
            @endforeach

        </table>

    </p>
    
    <p>
        PCT: {{$namePct}}<br>
        End: {{$strEndPct}} - {{$cityPct}}<br>
        Contato: {{$celContatoPct}} ({{$respPct}})
        <br>
        
    </p>


    <p>Att.</p>
    <p>MH Suprimentos</p>

</body>
</html>

