<?php 
    class Usuario {
        function Ingresar($correo, $clave){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM usuarios WHERE correo = '$correo' AND clave = '$clave'";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                
                while($fila = $resultado->fetch_assoc()){
                    $id = $fila['id'];
                    break;
                }
                
                $conexion->close();
                return $id;
            }

            $conexion->close();
            return 0;
        }

        function Registrar($correo, $clave, $buscador){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){

            }else{
                $sql = "INSERT INTO usuarios (correo, clave, buscador) VALUES ('$correo', '$clave', '$buscador')";

                $resultado = $conexion->query($sql);

                $conexion->close();
                return $resultado;
            }

            $conexion->close();
            return false;
        }
    }
?>