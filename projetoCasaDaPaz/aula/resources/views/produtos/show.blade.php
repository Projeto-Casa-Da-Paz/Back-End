<!--<h1>Detalhes do Produto {{$produto->nome}}</h1>-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Produto</title>
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
                Detalhes do Produto {{$produto->nome}}
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{$produto->id}}</p>
                <p><strong>Nome:</strong> {{$produto->nome}}</p>
                <p><strong>Categoria:</strong> {{$produto->categoria}}</p>
                <p><strong>Quantidade Estoque:</strong> {{$produto->qtd_estoque}}</p>
                <br>
                <a class="btn btn-success" href="{{route('produtos.index')}}">Principal</a>
            </div>
        </div>
    </div>
</body>

</html>
