<?php

class Produto
{

    private $id;
    private $nome;
    private $preco;
    private $quantidade;

    public function __construct($idProduto, $nome,$marca, $preco, $quantidade)
    {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->marca=$marca;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function getIdProduto()
    {
        return $this->idProduto;
    }

    public function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setMarca($marca)
    {
        $this->marca = $marca;
    }
    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

}