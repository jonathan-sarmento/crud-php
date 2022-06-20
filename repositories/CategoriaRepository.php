<?php

require_once("../model/Categoria.php");
require_once("Banco.php");
class CategoriaRepository{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = Banco::conectar();
    }

    public function Create(Categoria $categoria){
        $stmt = $this->mysqli->prepare("INSERT INTO categoria (`nmcategoria`, `decategoria`) VALUES (?,?)");

         if( $stmt->execute(array($categoria->Nome, $categoria->Descricao)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }

    public function GetAll(){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM categoria';
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $categoria){
            array_push($array, $this->QueryToModel($categoria));
        }

        return $array;
    }

    public function GetById($id){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM categoria WHERE cdcategoria = ' .$id;
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $categoria){
            array_push($array, $this->QueryToModel($categoria));
        }

        return $array;
    }

    private function QueryToModel($value){
        $model = new Categoria();

        $model->Id = $value['CDCATEGORIA'];
        $model->Nome = $value['NMCATEGORIA'];
        $model->Descricao = $value['DECATEGORIA'];

        return $model;
    }

    public function Update(Categoria $categoria){
       
        $sql = "UPDATE categoria  set nmcategoria = ?, decategoria = ? WHERE cdcategoria = ?";
        
        $q = $this->mysqli->prepare($sql);

        if( $q->execute(array($categoria->Nome, $categoria->Descricao, $categoria->Id)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }
    }

    public function Delete($id){
        if($this->mysqli->query("DELETE FROM `categoria` WHERE `cdcategoria` = '".$id."';")== TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }
}
?>
