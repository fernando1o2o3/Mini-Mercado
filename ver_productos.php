<?php
    include("./Acceso/Producto.php");

    session_start();

    $productoClass = new Producto();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="app.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <div class="pt-5 col-md-4 text-center container">
        <form action="./ver_productos.php" method="POST" id="ver_productos">
            <?php 
                if(isset($_SESSION['buscador'])){
                ?>
                    <div class="text-white"><?= $_SESSION['buscador'] ?></div>
            <?php 
                }
            ?>
            <input type="text" name="buscador" class="form-control mb-3 mt-3 text-center" placeholder="Buscador">
        </form>
        <button type="submit" class="btn btn-primary" name="buscar" form="ver_productos">Buscar</button>
        <a href="./index.php" class="btn btn-success">Volver</a>
    </div>
    <div class="row p-5">
    <?php 
        if(isset($_POST['buscar'])){
            $buscador = $_POST['buscador'];

            if($productoClass->BuscarProductosPorBuscador($buscador)){
                $_SESSION['buscador'] = "";
            }else{
                $_SESSION['buscador'] = "No se encontro ningun usuario con este buscador";
            }
        }
    ?>
    </div>
</body>
</html>