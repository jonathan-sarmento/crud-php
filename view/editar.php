<!DOCTYPE HTML>
<html>
<?php include("head.php"); 
require_once("../controller/ProdutoController.php");?>
<?php

    $id = null;
    $produto = null;
    $controller = null;

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        $controller = new ProdutoController();
        $produto = $controller->ProdutoPorId($id)[0];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new ProdutoController();
        $controller->EditarProduto();
    }
?>
<body>
    <?php include("menu.php") ?>
    <div class="row">
        <form method="post" action="editar.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <label class="control-label">Nome:</label>
                <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $produto->Nome; ?>" required autofocus>
                <label class="control-label">Preco:</label>
                <input class="form-control" type="text" id="preco" name="preco" value="<?php echo $produto->Preco; ?>" required>
                <label class="control-label">Quantidade:</label>
                <input class="form-control" type="number" id="quantidade" name="quantidade" value="<?php echo $produto->Quantidade; ?>" required>
                <label class="control-label">Fornecedor:</label>
                <input class="form-control" type="number" id="fornecedor-id" name="fornecedor-id" value="<?php echo $produto->FornecedorId; ?>" required>
                <label class="control-label">Categoria:</label>
                <input class="form-control" type="number" id="categoria-id" name="categoria-id" value="<?php echo $produto->CategoriaId; ?>" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $produto->Id;?>">
                <button type="submit" class="btn btn-success" id="editar" name="editar" value="editar">Editar</button>
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
                alert('A quantidade do produto não pode ser igual ou inferior a 0');
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
