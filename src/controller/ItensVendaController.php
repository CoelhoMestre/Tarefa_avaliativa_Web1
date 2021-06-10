<?php

require_once '../model/ItensVenda.php';
require_once '../model/Database.php';

class ItensVendaController extends ItensVenda
{
    protected $tabela = 'itensVenda';

    public function __construct()
    {
    }

    public function insert($idVenda, $idProduto, $quantidade, $valorUnitario)
    {
        $query = "INSERT INTO $this->tabela (idVenda, idProduto, quantidade, valorUnitario) VALUES (:idVenda, :idProduto, :quantidade, :valorUnitario)";
        $stm = Database::prepare($query);
        $stm->bindParam(':idVenda', $idVenda);
        $stm->bindParam(':idProduto', $idProduto);
        $stm->bindParam(':quantidade', $quantidade);
        $stm->bindParam(':valorUnitario', $valorUnitario);
        return $stm->execute();
    }


    public function findAllIdVenda($idVenda)
    {
        $query = "SELECT * FROM $this->tabela WHERE idVenda = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idVenda, PDO::PARAM_INT);
        $stm->execute();
        $itensVenda = array();

        foreach ($stm->fetchAll() as $itemVenda) {
            array_push(
                $itensVenda,
                new ItensVenda($itemVenda->idItensVenda, $idVenda, $itemVenda->idProduto, $itemVenda->quantidade, $itemVenda->valorUnitario)
            );
        }
        return $itensVenda;
    }

    public function delete($idVenda)
    {
        $query = "DELETE FROM $this->tabela WHERE idVenda = :id";
        $stm = Database::prepare($query);
        $stm->bindParam(':id', $idVenda, PDO::PARAM_INT);
        return $stm->execute();
    }

}