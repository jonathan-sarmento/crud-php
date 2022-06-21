<!DOCTYPE HTML>
<html>
<?php include("head.php"); ?>
<?php require_once("../controller/ProdutoController.php"); ?>
<?php require_once("../repositories/FornecedorRepository.php"); ?>
<?php require_once("../repositories/CategoriaRepository.php"); ?>
<?php
    $categoriaRepository = new CategoriaRepository();
    $fornecedorRepository = new FornecedorRepository();

    $fornecedores = $fornecedorRepository->GetAll();
    $categorias = $categoriaRepository->GetAll();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new ProdutoController();
        $controller->CriarProduto();
    }

?>
<body>
<hr>
<a href="ProdutoIndex.php" class="btn btn-default">Voltar</a>
<hr>
    <div class="row">
        <form method="post" action="ProdutoCreate.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <label class="control-label">Nome:</label>
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome do produto" required autofocus>
                <label class="control-label">Preco:</label>
                <input class="form-control" type="text" id="preco" name="preco" placeholder="Preco" required>
                <label class="control-label">Quantidade:</label>
                <input class="form-control" type="text" id="quantidade" name="quantidade" placeholder="Quantidade" required>
                <label class="control-label">Fornecedor:</label>
                <select class="form-select" aria-label="Default select example" id="fornecedor-id" name="fornecedor-id"  required>
                    <option selected>Nenhum</option>
                    <?php
                        foreach($fornecedores as $fornecedor){
                            echo '<option value="'.$fornecedor->Id."\"".'>'.$fornecedor->RazaoSocial.'</option>';
                        }                    
                    ?>
                </select>
                <label class="control-label">Categoria:</label>
                <select class="form-select" aria-label="Default select example" id="categoria-id" name="categoria-id"  required>
                    <option selected>Nenhum</option>
                    <?php
                        foreach($categorias as $categoria){
                            echo '<option value="'.$categoria->Id."\"".'>'.$categoria->Nome.'</option>';
                        }                    
                    ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" id="cadastrar" name="cadastrar" value="Cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>

    <script language="javascript" type="text/javascript">
        function formatarMoeda() {
            var elemento = document.getElementById('preco');
            var valor = preco.value;

            valor = valor + '';
            valor = parseInt(valor.replace(/[\D]+/g, ''));
            valor = valor + '';
            valor = valor.replace(/([0-9]{2})$/g, ",$1");

            if (valor.length > 6) {
                valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
            }

            elemento.value = valor;
        }



        function validar(formulario) {
            var quantidade = form.quantidade.value;
            var preco = form.preco.value;
            for (i = 0; i <= formulario.length - 2; i++) {
                if ((formulario[i].value == "")) {
                    alert("Preencha o campo " + formulario[i].name);
                    formulario[i].focus();
                    return false;
                }
            }
            if (quantidade <= 0) {
                alert('A quantidade de produtos não pode ser igual ou inferior a 0');
                form.quantidade.focus();
                return false;
            }
            if (preco <= 0) {
                alert('O preço do produto não pode ser igual ou infeiror a 0');
                form.preco.focus();
                return false;
            }
            formulario.submit();
        }

    </script>
</body>

</html>
