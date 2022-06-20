<!DOCTYPE HTML>
<html>
<?php include("head.php"); ?>
<?php require_once("../controller/CategoriaController.php"); ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new CategoriaController();
        $controller->CriarCategoria();
    }
?>
<body>
<hr>
<a href="CategoriaIndex.php" class="btn btn-default">Voltar</a>
<hr>
    <div class="row">
        <form method="post" action="CategoriaCreate.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Nome da categoria" required autofocus>
                <input class="form-control" type="text" id="descricao" name="descricao" placeholder="Descricao" required>
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
