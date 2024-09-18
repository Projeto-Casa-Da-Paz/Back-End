<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">UniAlfa</a>
        </div>
    </nav>
    <div class="container">
        <h1>Lista de Produtos</h1>
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Categoria</td>
                    <td>Quantidade em Estoque</td>
                    <td>Ações</td>
                </tr>
            </thead>
            <tbody>
                @foreach($produtos as $produto)
                <tr><!--O foreach percorre o array do banco e imprime os dados do clients -->
                    <td>{{$produto->id}}</td>
                    <td><a href="{{route('produtos.show',$produto)}}">{{$produto->nome}}</a></td>
                    <td>{{$produto->categoria}}</td>
                    <td>{{$produto->qtd_estoque}}</td>
                    <td>
                    <a class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                    <a class="btn btn-danger"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
