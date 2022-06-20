<!DOCTYPE HTML>
<html>
<?php include("head.php"); 
require_once("../controller/FornecedorController.php");?>
<?php

    $id = null;
    $fornecedor = null;
    $controller = null;

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        $controller = new FornecedorController();
        $fornecedor = $controller->FornecedorPorId($id)[0];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $controller = new FornecedorController();
        $controller->EditarFornecedor();
    }
?>
<body>
<a href="FornecedorIndex.php" class="btn btn-default">Voltar</a>
    <div class="row">
        <form method="post" action="FornecedorUpdate.php" id="form" name="form" onsubmit="validar(document.form); return false;" class="col-10">
            <div class="form-group">
                <label class="control-label">CNPJ:</label>
                <input class="form-control" type="text" id="cnpj" name="cnpj" value="<?php echo $fornecedor->Cnpj; ?>" required autofocus>
                <label class="control-label">Razão social:</label>
                <input class="form-control" type="text" id="razao-social" name="razao-social" value="<?php echo $fornecedor->RazaoSocial; ?>" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $fornecedor->Id;?>">
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
