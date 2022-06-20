<?php

require_once("../repositories/FornecedorRepository.php");
class FornecedorController{

    public function __construct(){
        
    }

    public function ListarFornecedores(){
        
        $_repository = new FornecedorRepository();
        $row = $_repository->GetAll();
        foreach ($row as $fornecedor){
            echo "<tr>";
            echo "<th>".$fornecedor->Id ."</th>";
            echo "<th>".$fornecedor->Cnpj ."</th>";
            echo "<th>".$fornecedor->RazaoSocial ."</th>";
            echo "<td><a class='btn btn-warning' href='FornecedorUpdate.php?id=".$fornecedor->Id."'>Editar</a><a class='btn btn-danger' href='FornecedorDelete.php?id=".$fornecedor->Id."'>Excluir</a></td>";
            echo "</tr>";
        }
    }

    public function FornecedorPorId($id){

        $_repository = new FornecedorRepository();
        $fornecedor = $_repository->GetById($id);

        return $fornecedor;
    }

    public function CriarFornecedor(){

        $_repository = new FornecedorRepository();

        $fornecedor = new Fornecedor();
        $fornecedor->Cnpj = $_POST['cnpj'];
        $fornecedor->RazaoSocial = $_POST['razao-social'];

        $result = $_repository->Create($fornecedor);

        if($result >= 1){
            echo "<script>alert('Registro incluído com sucesso!');document.location='../view/FornecedorIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function EditarFornecedor(){

        $_repository = new FornecedorRepository();

        $fornecedor = new Fornecedor();
        $fornecedor->Id = $_POST['id'];
        $fornecedor->Cnpj = $_POST['cnpj'];
        $fornecedor->RazaoSocial = $_POST['razao-social'];

        $result = $_repository->Update($fornecedor);

        if($result >= 1){
            echo "<script>alert('Registro alterado com sucesso!');document.location='../view/FornecedorIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function DeletarFornecedor($id){

        $_repository = new FornecedorRepository();

        $result = $_repository->Delete($id);

        if($result){
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/FornecedorIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }

}
