<?php

require_once '../model/Produto.php';
require_once '../model/Database.php';

class ProdutosController extends Produto
{
    protected $tabela = 'produto';
    public function __construct()
    {
    }
    public function findOne($idProduto)
    {
        $query = "SELECT * FROM $this->tabela WHERE idProduto = :idProduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
        $stm->execute();
        $produto = new Produto(null, null, null,null, null);

        foreach ($stm->fetchAll() as $pr) {
            $produto->setIdProduto($pr->idproduto);
            $produto->setNome($pr->nome);
            $produto->setNome($pr->marca);
            $produto->setPreco($pr->valor);
            $produto->setQuantidade($pr->quantidade);
        }
        return $produto;
    }
    public function findAll()
    {
        $query = "SELECT * FROM $this->tabela";
        $stm = Database::prepare($query);
        $stm->execute();
        $produtos = array();

        foreach ($stm->fetchAll() as $produto) {
            $produtos[]= new Produto($produto->idproduto, $produto->nome,$produto->marca, $produto->valor, $produto->quantidade);
        } 
        
        return $produtos;
    }
    public function insert($nome,$marca, $preco, $quantidade)
    {
        $query = "INSERT INTO $this->tabela (nome, marca, valor, quantidade) VALUES (:nome,:marca, :valor, :quantidade)";
        $stm = Database::prepare($query);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':marca', $marca);
        $stm->bindParam(':valor', $preco);
        $stm->bindParam(':quantidade', $quantidade);
        return $stm->execute();
    }
    public function update($idProduto)
    {
        $nome = $this->getNome();
        $preco = $this->getPreco();
        $quantidade = $this->getQuantidade();
        $query = "UPDATE $this->tabela SET nome = :nome, marca= :marca, valor = :valor, quantidade = :quantidade WHERE idProduto = :idProduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
        $stm->bindParam(':nome', $nome);
        $stm->bindParam(':marca', $marca);
        $stm->bindParam(':valor', $preco);
        $stm->bindParam(':quantidade', $quantidade);
        return $stm->execute();
    }
    public function delete($idProduto)
    {
        $query = "DELETE FROM $this->tabela WHERE idProduto = :idProduto";
        $stm = Database::prepare($query);
        $stm->bindParam(':idProduto', $idProduto, PDO::PARAM_INT);
        return $stm->execute();
    }
   
}
