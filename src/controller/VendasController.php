<?php

require_once '../model/Venda.php';
require_once '../model/Database.php';

class VendasController extends Venda
{
    protected $tabela = 'venda';

    public function __construct()
    {
    }

    
    public function findOne($idVenda)
    {
        $query = "SELECT * FROM $this->tabela WHERE idVenda = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idVenda, PDO::PARAM_INT);
        $stm->execute();
        $venda = new Venda(null, null, null);

        foreach ($stm->fetchAll() as $ven) {
            $venda->setIdVenda($ven->idvenda);
            $venda->setIdCliente($ven->idcliente);
            $venda->setValorTotal($ven->valortotal);
        }
        return $venda;
    }

    
    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $vendas = array();

        foreach ($stm->fetchAll() as $venda) {
            array_push(
                $vendas,
                new Venda($venda->idvenda, $venda->idcliente, $venda->valortotal)
            );
        }

        return $vendas;
    }

  
    public function insert($idCliente, $valorTotal)
    {
        $query = "INSERT INTO $this->tabela (idCliente, valorTotal) VALUES (:idCliente, :valorTotal)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idCliente', $idCliente);
        $stm->bindParam(':valorTotal', $valorTotal);
        return $stm->execute();
    }

   
    public function findIdVenda($idCliente)
    {
        $idVenda = null;
        $query = "SELECT idVenda FROM $this->tabela WHERE idCliente = :id AND valorTotal = 0";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idCliente, PDO::PARAM_INT);
        $stm->execute();

        foreach ($stm->fetchAll() as $venda) {
            $idVenda = $venda->idvenda;
        }
        return $idVenda;
    }

    
    public function delete($idVenda)
    {
        $query = "DELETE FROM $this->tabela WHERE idvenda = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idVenda, PDO::PARAM_INT);
        return $stm->execute();
    }

}