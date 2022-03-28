<?php
    include("./Acceso/Nota.php");

    session_start();

    $notaClass = new Nota();

    if(!isset($_SESSION['permisos'])){
        header("Location: index.php");
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $notaClass->EliminarNota($id);

        header("Location: notas.php");
    }
?>