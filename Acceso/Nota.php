<?php 
    class Nota {
        function MostrarTodos($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM notas WHERE id_usuario = $id ORDER BY fecha_realizacion DESC";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    echo("
                    <div class='card bg-dark border-info text-white col-md-3 m-5 text-center'>
                        <div class='card-body'>
                            <h3>".$fila['titulo']."</h3><br>
                            <p>".$fila['descripcion']."<br>"
                            .$fila['fecha_realizacion']."<br><br>
                            <a href='editar_nota.php?id=".$fila['id']."' class='btn btn-success me-3 mt-3'>Editar</a>
                            <a href='eliminar_nota.php?id=".$fila['id']."' class='btn btn-danger mt-3'>Eliminar</a>
                            </p>
                        </div>
                    </div>");
                }
            }
        }

        function CantidadNotas($id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT COUNT(*) AS total FROM notas WHERE id_usuario = $id_usuario";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return $fila['total'];
                }
            }
        }

        function AgregarNota($titulo, $descripcion, $fecha_realizacion, $id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            if($this->CantidadNotas($id_usuario) <= 20){
                $sql = "INSERT INTO notas (titulo, descripcion, fecha_realizacion, id_usuario) 
                        VALUES ('$titulo', '$descripcion', '$fecha_realizacion', $id_usuario)";

                $resultado = $conexion->query($sql);

                $conexion->close();

                return $resultado;
            }else{
                return false;
            }
        }

        function EliminarNota($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "DELETE FROM notas 
                    WHERE id = $id";

            $conexion->query($sql);

            $conexion->close();
        }

        function EditarNota($titulo, $descripcion, $fecha_realizacion, $id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "UPDATE notas
                    SET
                    titulo = '$titulo',
                    descripcion = '$descripcion',
                    fecha_realizacion = '$fecha_realizacion'
                    WHERE id = $id";

            $conexion->query($sql);

            $conexion->close();
        }

        function buscarNota($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM notas 
                    WHERE id = $id";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return [$fila['titulo'], $fila['descripcion'], $fila['fecha_realizacion']];
                }
            }
        }
    }

?>