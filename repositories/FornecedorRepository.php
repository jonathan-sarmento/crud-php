<?php

require_once("../model/Fornecedor.php");
require_once("Banco.php");
class FornecedorRepository{

    protected $mysqli;

    public function __construct(){
        $this->conexao();
    }

    private function conexao(){
        $this->mysqli = Banco::conectar();
    }

    public function Create(Fornecedor $fornecedor){
        $stmt = $this->mysqli->prepare("INSERT INTO fornecedor (`cnpj`, `razaosocial`) VALUES (?,?)");

         if( $stmt->execute(array($fornecedor->Cnpj, $fornecedor->RazaoSocial)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }

    public function GetAll(){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM fornecedor';
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $fornecedor){
            array_push($array, $this->QueryToModel($fornecedor));
        }

        return $array;
    }

    public function GetById($id){
        $pdo = Banco::conectar();
        $sql = 'SELECT * FROM fornecedor WHERE cdfornecedor = ' .$id;
        $result = $pdo->query($sql);
        Banco::desconectar();
        $array = array();
        foreach($result as $fornecedor){
            array_push($array, $this->QueryToModel($fornecedor));
        }

        return $array;
    }

    private function QueryToModel($value){
        $model = new Fornecedor();

        $model->Id = $value['CDFORNECEDOR'];
        $model->Cnpj = $value['CNPJ'];
        $model->RazaoSocial = $value['RAZAOSOCIAL'];

        return $model;
    }

    public function Update(Fornecedor $fornecedor){
       
        $sql = "UPDATE fornecedor  set cnpj = ?, razaosocial = ? WHERE cdfornecedor = ?";
        
        $q = $this->mysqli->prepare($sql);

        if( $q->execute(array($fornecedor->Cnpj, $fornecedor->RazaoSocial, $fornecedor->Id)) == TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }
    }

    public function Delete($id){
        if($this->mysqli->query("DELETE FROM `fornecedor` WHERE `cdfornecedor` = '".$id."';")== TRUE){
            Banco::desconectar();
            return true;
        }else{
            Banco::desconectar();
            return false;
        }

    }
}
?>
