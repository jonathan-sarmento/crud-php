<?php

require_once("../model/Produto.php");
require_once("Banco.php");
class ProdutoRepository{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = Banco::conectar();
    }

    public function Create(Produto $produto){
        $stmt = $this->mysqli->prepare("INSERT INTO produto (`nmproduto`, `preco`, `quantidade`, `cdfornecedor`, `cdcategoria`) VALUES (?,?,?,?,?)");

         if( $stmt->execute(array($produto->Nome, $produto->Preco, $produto->Quantidade, $produto->FornecedorId,$produto->CategoriaId)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }

    public function GetAll(){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM produto';
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $produto){
            array_push($array, $this->QueryToModel($produto));
        }

        return $array;
    }

    public function GetById($id){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM produto WHERE cdproduto = ' .$id;
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $produto){
            array_push($array, $this->QueryToModel($produto));
        }

        return $array;
    }

    private function QueryToModel($value){
        $model = new Produto();

        $model->Id = $value['CDPRODUTO'];
        $model->Nome = $value['NMPRODUTO'];
        $model->Preco = $value['PRECO'];
        $model->Quantidade = $value['QUANTIDADE'];
        $model->FornecedorId = $value['CDFORNECEDOR'];
        $model->CategoriaId = $value['CDCATEGORIA'];

        return $model;
    }

    public function Update(Produto $produto){
       
        $sql = "UPDATE produto  set nmproduto = ?, preco = ?, quantidade = ?, cdfornecedor = ?, cdcategoria = ? WHERE cdproduto = ?";
        
        $q = $this->mysqli->prepare($sql);

        if( $q->execute(array($produto->Nome, $produto->Preco, $produto->Quantidade, $produto->FornecedorId,$produto->CategoriaId, $produto->Id)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }
    }

    public function Delete($id){
        if($this->mysqli->query("DELETE FROM `produto` WHERE `cdproduto` = '".$id."';")== TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }
}
?>
