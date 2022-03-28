<?php
    include("./Acceso/Factura.php");

    session_start();

    $facturaClass = new Factura();

    if(!isset($_SESSION['permisos'])){
        header("Location: index.php");
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $facturaClass->EliminarFactura($id);

        header("Location: facturas.php");
    }
?>