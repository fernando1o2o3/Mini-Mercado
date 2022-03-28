<?php
    include("./Acceso/Producto.php");

    session_start();

    $productoClass = new Producto();

    if(!isset($_SESSION['permisos'])){
        header("Location: index.php");
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $productoClass->EliminarProducto($id);

        header("Location: principal.php");
    }
?>