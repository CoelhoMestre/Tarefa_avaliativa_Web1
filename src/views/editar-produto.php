<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/styles/main.css">
</head>

<body>
    <div class="container">
        <?php

            require '../controller/ProdutosController.php';
            if(!$_GET) header('Location: ./produtos.php');;
            $idProduto = $_GET['id'];
            $produto = new ProdutosController();
            $produto->setIdProduto($idProduto);
            $produto->setNome($produto->findOne($idProduto)->getNome());
            $produto->setMarca($produto->findOne($idProduto)->getMarca());
            $produto->setPreco($produto->findOne($idProduto)->getPreco());
            $produto->setQuantidade($produto->findOne($idProduto)->getQuantidade());

        ?>
        <h1 class="p-1 title">Editar</h1>
        <div class="menu p-2">
            <a href="../../index.php" class="btn btn-sm btn-outline-primary">VOLTAR</a>
        </div>
        <form class='form' action="./editar-produto.php?id=<?= $produto->getIdProduto() ?>" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" value="<?= $produto->getNome() ?>" name="nome" class="form-control" id="nome" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" value="<?= $produto->getNome() ?>" name="marca" class="form-control" id="marca" autocomplete="off" required>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <div class="input">
                    <label for="preco" class="form-label">Pre??o</label>
                    <input type="number" value="<?= $produto->getPreco() ?>" step="any" name="preco" class="form-control" id="preco" required>
                </div>
                <div class="input">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" value="<?= $produto->getQuantidade() ?>" step="any" name="quantidade" class="form-control" id="quantidade" required>
                </div>
            </div>

            <div class="button">
                <button type="submit" class="btn btn-primary">Pronto</button>
            </div>
        </form>
        <?php

            if(!$_POST) return;
            $produto->setNome($_POST['nome-produto']);
            $produto->setMarca($_POST['marca']);
            $produto->setPreco($_POST['preco']);
            $produto->setQuantidade($_POST['quantidade']);

            try {
                $produto->update($idProduto);
                header("Location: ./produtos.php");
            } catch (PDOException $err) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                          Ocorreu um erro ao atualizar o Produto!
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      <script>console.error(\''.$err->getMessage().'\')</script>';
            } 

        ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</html>