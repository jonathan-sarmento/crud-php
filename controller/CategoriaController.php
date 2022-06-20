<?php

require_once("../repositories/CategoriaRepository.php");
class CategoriaController{

    public function __construct(){
        
    }

    public function ListarCategorias(){
        
        $_repository = new CategoriaRepository();
        $row = $_repository->GetAll();
        foreach ($row as $categoria){
            echo "<tr>";
            echo "<th>".$categoria->Id ."</th>";
            echo "<th>".$categoria->Nome ."</th>";
            echo "<th>".$categoria->Descricao ."</th>";
            echo "<td><a class='btn btn-warning' href='CategoriaUpdate.php?id=".$categoria->Id."'>Editar</a><a class='btn btn-danger' href='CategoriaDelete.php?id=".$categoria->Id."'>Excluir</a></td>";
            echo "</tr>";
        }
    }

    public function CategoriaPorId($id){

        $_repository = new CategoriaRepository();
        $categoria = $_repository->GetById($id);

        return $categoria;
    }

    public function CriarCategoria(){

        $_repository = new CategoriaRepository();

        $categoria = new Categoria();
        $categoria->Nome = $_POST['nome'];
        $categoria->Descricao = $_POST['descricao'];

        $result = $_repository->Create($categoria);

        if($result >= 1){
            echo "<script>alert('Registro incluído com sucesso!');document.location='../view/CategoriaIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function EditarCategoria(){

        $_repository = new CategoriaRepository();

        $categoria = new Categoria();
        $categoria->Id = $_POST['id'];
        $categoria->Nome = $_POST['nome'];
        $categoria->Descricao = $_POST['descricao'];

        $result = $_repository->Update($categoria);

        if($result >= 1){
            echo "<script>alert('Registro alterado com sucesso!');document.location='../view/CategoriaIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function DeletarCategoria($id){

        $_repository = new CategoriaRepository();

        $result = $_repository->Delete($id);

        if($result){
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/CategoriaIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }

}
