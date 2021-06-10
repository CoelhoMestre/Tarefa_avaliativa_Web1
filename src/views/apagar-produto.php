<?php

require '../controller/ProdutosController.php';
if (!$_GET) header('Location: ./produtos.php');

$produto = new ProdutosController();
$produto->setIdProduto($_GET['id']);
$produto->delete($produto->getIdProduto());
    header('Location: ./produtos.php');