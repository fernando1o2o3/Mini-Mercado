<?php 
    class Producto {
        function MostrarTodos($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM productos 
                    WHERE id_usuario = $id";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    $disponible = $fila['disponible'] ? "Disponible" : "No Disponible" ;

                    echo("
                    <div class='card bg-dark border-info text-white col-md-3 m-5 text-center'>
                        <div class='card-body'>
                            <h3>".$fila['nombre']."</h3>
                            <p>".$fila['nombre_empresa']."<br><br>
                            Precio: ".$fila['precio']."<br>"
                            .$disponible."<br><br>
                            <a href='editar_producto.php?id=".$fila['id']."' class='btn btn-success me-3'>Editar</a>
                            <a href='eliminar_producto.php?id=".$fila['id']."' class='btn btn-danger'>Eliminar</a>
                            </p>
                        </div>
                    </div>");
                }
            }
        }

        function CantidadProductos($id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT COUNT(*) AS total FROM productos WHERE id_usuario = $id_usuario";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return $fila['total'];
                }
            }
        }

        function AgregarProducto($nombre, $precio, $nombre_empresa, $disponible, $id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            if($this->CantidadProductos($id_usuario) <= 20){
                $sql = "INSERT INTO productos (nombre, precio, nombre_empresa, disponible, id_usuario) 
                        VALUES ('$nombre', $precio, '$nombre_empresa', $disponible, $id_usuario)";

                $resultado = $conexion->query($sql);

                $conexion->close();

                return $resultado;
            }else{
                return false;
            }
        }

        function EliminarProducto($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "DELETE FROM productos 
                    WHERE id = $id";

            $conexion->query($sql);

            $conexion->close();
        }

        function EditarProducto($nombre, $precio, $nombre_empresa, $disponible, $id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "UPDATE productos
                    SET
                    nombre = '$nombre',
                    precio = $precio,
                    nombre_empresa = '$nombre_empresa',
                    disponible = $disponible
                    WHERE id = $id";

            $conexion->query($sql);

            $conexion->close();
        }

        function buscarProducto($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM productos 
                    WHERE id = $id";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return [$fila['nombre'], $fila['nombre_empresa'], $fila['precio'], $fila['disponible'],$fila['id']];
                }
            }
        }

        function mostrarProductos($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT nombre, precio
                    FROM productos 
                    WHERE id_usuario = $id";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    echo("<option value='".$fila['nombre']." = ".$fila['precio']."'>".$fila['nombre']."</option>");
                }
            }
        }

        function BuscarProductosPorBuscador($buscador){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT id FROM usuarios WHERE buscador = $buscador";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    $id_usuario = $fila['id'];
                    break;
                }
            }

            if(isset($id_usuario)){
                $sql = "SELECT * FROM productos WHERE id_usuario = $id_usuario";

                $resultado = $conexion->query($sql);

                if($resultado && $resultado->num_rows > 0){
                    while($fila = $resultado->fetch_assoc()){
                        if($fila['disponible']){
                            echo("
                            <div class='card bg-dark border-info text-white col-md-3 m-5 text-center'>
                                <div class='card-body'>
                                    <h3>".$fila['nombre']."</h3>
                                    <p>
                                    Precio: ".$fila['precio']."<br>
                                    </p>
                                </div>
                            </div>");
                        }
                    }
                    
                    $conexion->close();

                    return true;
                }
            }

            return false;
        }
    }
?>