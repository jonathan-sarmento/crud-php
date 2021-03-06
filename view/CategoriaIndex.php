<?php require_once("../controller/CategoriaController.php");?>
<!DOCTYPE html>
<html lang="pt-br">

<?php include("head.php"); ?>

<body>
<?php include("menu.php") ?>
<h1>Categoria</h1>
<a href="CategoriaCreate.php" class="btn btn-success">Cadastar</a>
<hr>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descricao</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php $controller = new CategoriaController(); 
                  $controller->ListarCategorias();  
             ?>

        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>
