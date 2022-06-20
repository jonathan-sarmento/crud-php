<?php
require_once("../controller/ProdutoController.php");

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        
        $controller = new ProdutoController();
        $produto = $controller->DeletarProduto($id);
    }
?>
