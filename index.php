<?php
    session_start();

    include("./Acceso/Usuario.php");

    if(isset($_GET['iniciar_sesion'])){
        $usuarioClass = new Usuario();

        $correo = $_GET['correo'];
        $clave = $_GET['clave'];

        $id = $usuarioClass->Ingresar($correo, $clave);

        if($id != 0){
            $_SESSION['permisos'] = $id;
            header("Location: principal.php");
        }else{
            $_SESSION['validacion'] = "El usuario no existe";
        }
    }
    
    if(isset($_POST['registrarse'])){
        $usuarioClass = new Usuario();

        $correo = $_POST['correo'];
        $clave = $_POST['clave'];
        $buscador = $_POST['buscador'];

        if($correo != "" && $clave != "" && $buscador != ""){
            if($usuarioClass->Registrar($correo, $clave, $buscador)){
                $_SESSION['validacion'] = "El usuario se registro correctamente";
            }else{
                $_SESSION['validacion'] = "El usuario no se registro (correo o buscador ya existentes)";
            }
        }else{
            $_SESSION['validacion'] = "El usuario no se registro (debe llenar todos los campos)";
        }
    }
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
        <img src="./Publico/imagenes/logo_minimercado.png" alt="Mini Mercado" class="pt-5 img-fluid">
        
        <form action="index.php" method="GET" id="iniciar_sesion" class="pt-5">
            <?php 
                if(isset($_SESSION['validacion'])){
                ?>
                    <div class="text-white"><?= $_SESSION['validacion'] ?></div>
            <?php 
                }
            ?>
            <input type="email" placeholder="Correo" name="correo" class="form-control m-3 text-center">
            <br>
            <input type="password" placeholder="Clave" name="clave" class="form-control m-3 text-center">
            <button type="submit" name="iniciar_sesion" class="btn btn-primary mt-5 ps-5 pe-5">Iniciar Sesion</button>
        </form>

        <form action="index.php" method="POST" id="registrarse" style="display: none;">
            <?php 
                if(isset($_SESSION['validacion'])){
                ?>
                    <div class="text-white"><?= $_SESSION['validacion'] ?></div>
            <?php 
                }
            ?>
            <input type="email" placeholder="Correo" name="correo" class="form-control m-3 text-center">
            <br>
            <input type="password" placeholder="Clave" name="clave" class="form-control m-3 text-center">
            <br>
            <input type="text" placeholder="Buscador" name="buscador" class="form-control m-3 text-center">
            <br>
            <p class="text-white">
                Este buscador es utilizado para que tus clientes puedan ver
                todos los productos que esten disponibles.
            </p>
            <button type="submit" name="registrarse" class="btn btn-primary mt-5 ps-5 pe-5">Registrarse</button>
        </form>
        
        <button onclick="cambiar()" id="accion" class="btn btn-success mt-5">Registrarse</button>
        
        <br><br><br><br><br><br>
        <p class="text-white">Quieres ver productos de nuestros usuarios?</p>
        <a href="./ver_productos.php" class="">Da Click Aqui</a>
    </div>
</body>
</html>