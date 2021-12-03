
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"ref="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Solicitação em Andamento!</title>
</head>
<body>
    {{-- <h3>Solicitação nº {{$idSolicitEmail}}</h3> --}}
    <h3>Solicitação em Andamento!</h3>

    <p>
        {{-- Solicitação de <b> {{$typeSolicitFimEmail}} </b> para o PCT {{$namePctEmail}} recebida,<br> --}}
        Sua solicitação para o (a) paciente <br> <b> {{$namePct}} </b> <br>já está a caminho.<br>

        <table border="1" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style= "background-color: #cce6ff; border-radius: 10px; border-color: rgb(255, 255, 255)">
            <tr>
                <th style="padding-left: 10px; border-style: none">
                    {{$typeSolicitFim}} nº:{{$idSolicit}}
                </th>
            </tr>
            <tr>
                <td style="padding-left: 10px; border-style: none">
                    <p>
                        Item(s) solicitado(s):<br>
                        {{-- Separa os itens por vírgula e joga numa lista --}}
                        @foreach (explode(',', $itensSolicit) as $equip)
                        <li>
                            {{$equip}}
                        </li>
                        @endforeach
                    </p>
                    <p>
                        @if ($obsSolicit != null)
                        <i>Obs: {{$obsSolicit}}</i>
                        @endif
                    </p>
                    {{-- <a href="https://www.requestcare.online" class="card-link">Acesse</a> --}}
                </td>
            </tr>
        </table>

    </p>
    {{-- @if ($obsAtendfimEmail != null)
        <i>Obs: {{$obsAtendfimEmail}}</i>
    @endif --}}
    <p>Em breve sua solicitação será concluída.<br>Att.</p>
    <p>MH Suprimentos</p>
</body>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>

