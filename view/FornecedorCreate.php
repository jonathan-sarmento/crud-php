<!DOCTYPE HTML>
<html>
<?php include("head.php"); ?>
<?php require_once("../controller/FornecedorController.php"); ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new FornecedorController();
        $controller->CriarFornecedor();
    }
?>
<body>
<hr>
<a href="FornecedorIndex.php" class="btn btn-default">Voltar</a>
<hr>
    <div class="row">
        <form method="post" action="FornecedorCreate.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <input class="form-control" type="text" id="cnpj" name="cnpj" placeholder="CNPJ" required autofocus>
                <input class="form-control" type="text" id="razao-social" name="razao-social" placeholder="Razão social" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success" id="cadastrar" name="cadastrar" value="Cadastrar">Cadastrar</button>
            </div>
        </form>
    </div>

    <script language="javascript" type="text/javascript">


        function validar(formulario) {
            for (i = 0; i <= formulario.length - 2; i++) {
                if ((formulario[i].value == "")) {
                    alert("Preencha o campo " + formulario[i].name);
                    formulario[i].focus();
                    return false;
                }
            }
            formulario.submit();
        }

    </script>
</body>

</html>
