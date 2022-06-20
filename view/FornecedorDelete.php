<?php
require_once("../controller/FornecedorController.php");

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        
        $controller = new FornecedorController();
        $fornecedor = $controller->DeletarFornecedor($id);
    }
?>
