<!DOCTYPE HTML>
<html>
<?php include("head.php"); 
require_once("../controller/CategoriaController.php");?>
<?php

    $id = null;
    $categoria = null;
    $controller = null;

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        $controller = new CategoriaController();
        $categoria = $controller->CategoriaPorId($id)[0];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new CategoriaController();
        $controller->EditarCategoria();
    }
?>
<body>
<a href="CategoriaIndex.php" class="btn btn-default">Voltar</a>
    <div class="row">
        <form method="post" action="CategoriaUpdate.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <label class="control-label">Nome:</label>
                <input class="form-control" type="text" id="nome" name="nome" value="<?php echo $categoria->Nome; ?>" required autofocus>
                <label class="control-label">Descricao:</label>
                <input class="form-control" type="text" id="descricao" name="descricao" value="<?php echo $categoria->Descricao; ?>" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $categoria->Id;?>">
                <button type="submit" class="btn btn-success" id="editar" name="editar" value="editar">Editar</button>
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
