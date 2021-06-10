<?php

require_once '../controller/ClientesController.php';
if (!$_GET) header('Location: ./clientes.php');

$cliente = new ClientesController();
$cliente->setIdCliente($_GET['id']);

$cliente->delete($cliente->getIdCliente());
    header('Location: ./clientes.php');