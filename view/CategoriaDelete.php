<?php
require_once("../controller/CategoriaController.php");

    $id = filter_input(INPUT_GET, 'id');
    if (!empty($id)) {
        $id = $_REQUEST['id'];
        
        $controller = new CategoriaController();
        $categoria = $controller->DeletarCategoria($id);
    }
?>
