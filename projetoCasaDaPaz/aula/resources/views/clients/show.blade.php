<!--<h1>Detalhes do Cliente {{$client->nome}}</h1>-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">UniAlfa</a>
        </div>
    </nav>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Detalhes do Cliente {{$client->nome}}
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{$client->id}}</p>
                <p><strong>Nome:</strong> {{$client->nome}}</p>
                <p><strong>Endereço:</strong> {{$client->endereco}}</p>
                <p><strong>Observação:</strong> {{$client->observacao}}</p>
                <br>
                <a class="btn btn-success" href="{{route('clients.index')}}">Principal</a>
            </div>
        </div>
    </div>
</body>

</html>
