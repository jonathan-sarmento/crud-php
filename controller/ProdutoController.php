<?php

require_once("../repositories/ProdutoRepository.php");
require_once("../repositories/CategoriaRepository.php");
require_once("../repositories/FornecedorRepository.php");
class ProdutoController{

    public function __construct(){
        
    }

    public function ListarProdutos(){
        
        $_repository = new ProdutoRepository();
        $_fornecedorRepository = new FornecedorRepository();
        $_categoriaRepository = new CategoriaRepository();

        $row = $_repository->GetAll();
        foreach ($row as $produto){
            $produto->Categoria = $_categoriaRepository->GetById($produto->CategoriaId)[0];
            $produto->Fornecedor = $_fornecedorRepository->GetById($produto->FornecedorId)[0];

            echo "<tr>";
            echo "<th>".$produto->Id ."</th>";
            echo "<th>".$produto->Nome ."</th>";
            echo "<th>R$ ".$produto->Preco ."</th>";
            echo "<th>".$produto->Quantidade ."</th>";
            echo "<td>".$produto->Fornecedor->RazaoSocial ."</td>";
            echo "<td>".$produto->Categoria->Nome ."</td>";
            echo "<td><a class='btn btn-warning' href='ProdutoUpdate.php?id=".$produto->Id."'>Editar</a><a class='btn btn-danger' href='ProdutoDelete.php?id=".$produto->Id."'>Excluir</a></td>";
            echo "</tr>";
        }
    }

    public function ProdutoPorId($id){

        $_repository = new ProdutoRepository();
        $produto = $_repository->GetById($id);

        return $produto;
    }

    public function CriarProduto(){

        $_repository = new ProdutoRepository();

        $produto = new Produto();
        $produto->Nome = $_POST['nome'];
        $produto->Quantidade = $_POST['quantidade'];
        $produto->Preco = $_POST['preco'];
        $produto->FornecedorId = $_POST['fornecedor-id'];
        $produto->CategoriaId = $_POST['categoria-id'];

        $result = $_repository->Create($produto);

        if($result >= 1){
            echo "<script>alert('Registro incluído com sucesso!');document.location='../view/ProdutoIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function EditarProduto(){

        $_repository = new ProdutoRepository();

        $produto = new Produto();
        $produto->Id = $_POST['id'];
        $produto->Nome = $_POST['nome'];
        $produto->Quantidade = $_POST['quantidade'];
        $produto->Preco = $_POST['preco'];
        $produto->FornecedorId = $_POST['fornecedor-id'];
        $produto->CategoriaId = $_POST['categoria-id'];

        $result = $_repository->Update($produto);

        if($result >= 1){
            echo "<script>alert('Registro alterado com sucesso!');document.location='../view/ProdutoIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }

    public function DeletarProduto($id){

        $_repository = new ProdutoRepository();

        $result = $_repository->Delete($id);

        if($result){
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/ProdutoIndex.php'</script>";
        }else{
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }

}
