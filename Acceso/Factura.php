<?php 
    class Factura {
        function MostrarTodos($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT * FROM facturas WHERE id_usuario = $id ORDER BY fecha_compra DESC";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    echo("
                    <div class='card bg-dark border-info text-white col-md-3 m-5 text-center'>
                        <div class='card-body'>
                            <h3 class='mt-5'>".$fila['nombre_comprador']."</h3>
                            <h3>".$fila['nombre_empresa']."</h3>
                            <p class='mt-5'>".$fila['productos']."<br>
                            Precio: ".$fila['precio_total']."<br>
                            Direccion: ".$fila['direccion']."<br>
                            Fecha: ".$fila['fecha_compra']."<br><br>
                            <a href='generar_factura.php?id=".$fila['id']."' class='btn btn-success mt-3 me-3'>Generar PDF</a> 
                            <a href='eliminar_factura.php?id=".$fila['id']."' class='btn btn-danger mt-3'>Eliminar</a>
                            </p>
                        </div>
                    </div>");
                }
            }
        }

        function CantidadFacturas($id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT COUNT(*) AS total FROM facturas WHERE id_usuario = $id_usuario";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return $fila['total'];
                }
            }
        }

        function mostrarDatosFactura($id_usuario, $id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "SELECT nombre_comprador, nombre_empresa, productos, precio_total, direccion, fecha_compra
            FROM facturas 
            WHERE id_usuario = $id_usuario AND id = $id";

            $resultado = $conexion->query($sql);

            if($resultado && $resultado->num_rows > 0){
                while($fila = $resultado->fetch_assoc()){
                    return [$fila['nombre_comprador'], $fila['nombre_empresa'], $fila['productos'], $fila['precio_total'], $fila['direccion'], $fila['fecha_compra']];
                }
            }
        }

        function AgregarFactura($nombre_empresa, $nombre_comprador, $direccion, $productos, $precio_total, $fecha_compra, $id_usuario){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            if($this->CantidadFacturas($id_usuario) <= 20){
                $sql = "INSERT INTO facturas (nombre_empresa, nombre_comprador, direccion, productos, precio_total, fecha_compra, id_usuario) 
                        VALUES ('$nombre_empresa', '$nombre_comprador', '$direccion', '$productos', $precio_total, '$fecha_compra', $id_usuario)";

                $resultado = $conexion->query($sql);

                $conexion->close();

                return $resultado;
            }else{
                return false;
            }
        }

        function EliminarFactura($id){
            $conexion = new mysqli("localhost", "root", "torterra12", "MiniMercado");

            if($conexion->connect_error){
                die("ERROR EN LA CONEXION");
            }

            $sql = "DELETE FROM facturas 
                    WHERE id = $id";

            $conexion->query($sql);

            $conexion->close();
        }
    }

?>
