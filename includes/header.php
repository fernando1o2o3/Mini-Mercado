<?php
    session_start();

    if(!isset($_SESSION['permisos'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniMercado</title>
    <script src="app.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="m-3">
        <a href="../MiniMercado/principal.php" class="navbar-brand">Principal</a>
        <a href="../MiniMercado/notas.php" class="navbar-brand">Notas</a>
        <a href="../MiniMercado/facturas.php" class="navbar-brand">Facturas</a>
        <a href="../MiniMercado/cerrar_sesion.php" class="navbar-brand">Cerrar Sesion</a>
    </div>
</nav>