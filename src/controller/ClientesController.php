<?php

require_once '../model/Cliente.php';
require_once '../model/Database.php';

class ClientesController extends Cliente
{
    protected $tabela = 'cliente';

    public function __construct()
    {
    }
    public function findOne($idCliente)
    {
        $query = "SELECT * FROM $this->tabela WHERE idCliente = :idCliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stm->execute();
        $cliente = new Cliente(null, null, null, null);
        foreach ($stm->fetchAll() as $cl) {
            $cliente->setIdCliente($cl->idcliente);
            $cliente->setNome($cl->nome);
            $cliente->setCpf($cl->cpf);   
        }
        return $cliente;
    }
    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $clientes = array();

        foreach ($stm->fetchAll() as $cliente) {
            array_push($clientes, new cliente($cliente->idcliente, $cliente->nome, $cliente->cpf));
        }
        return $clientes;
        
    }

    public function insert($nome, $cpf)
    {
        $query = "INSERT INTO $this->tabela (nome, cpf) VALUES (:nome, :cpf )";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':cpf', $cpf);
        return $stm->execute();
    }
    public function update($idCliente)
    {
        $query = "UPDATE $this->tabela SET nome = :nome, cpf = :cpf WHERE idCliente = :idCliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $stm->bindParam(':nome', $this->getNome());
        $stm->bindParam(':cpf',$this->getCpf());
        return $stm->execute();
    }
    public function delete($idCliente)
    {
        $query = "DELETE FROM $this->tabela WHERE idCliente = :idCliente";
        $stm = Database::prepare($query);
        $stm->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        return $stm->execute();
    }
}
