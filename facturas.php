<?php 
    include("./Acceso/Factura.php");
    include("./Acceso/Producto.php");
    include("./includes/header.php"); 
    
    $facturaClass = new Factura();
    $productoClass = new Producto();

    if(isset($_POST['agregar_factura'])){
        $nombre_empresa = $_POST['nombre_empresa'];
        $nombre_comprador = $_POST['nombre_comprador'];
        $direccion = $_POST['direccion'];
        $productos = $_POST['productos'];
        $precio_total = $_POST['precio_total'];
        $fecha_compra = $_POST['fecha_compra'];
        $id_usuario = $_SESSION['permisos'];

        if($nombre_empresa != "" && $nombre_comprador != "" && $direccion != "" && $productos != "" && $precio_total != "" && $fecha_compra != ""){
            if($facturaClass->AgregarFactura($nombre_empresa, $nombre_comprador, $direccion, $productos, $precio_total, $fecha_compra, $id_usuario)){
                $_SESSION['agregado_factura'] = "";
            }else{
                $_SESSION['agregado_factura'] = "No se agrego la factura";
            }
        }else{
            $_SESSION['agregado_factura'] = "No se agrego la factura";
        }
    }
?>
<div class="row p-5 text-center">
    <div class="card bg-dark border-info text-white col-md-3 m-5">
        <div class="card-body">
            <form action="facturas.php" method="post" id="agregar_factura">
                <?php 
                    if(isset($_SESSION['agregado_factura'])){
                    ?>
                        <div><?= $_SESSION['agregado_factura'] ?></div>
                <?php 
                    }
                ?>
                <input type="text" name="nombre_empresa" placeholder="Nombre Empresa" class="form-control mb-3 mt-3 text-center">
                <input type="text" name="nombre_comprador" placeholder="Nombre Comprador" class="form-control mb-3 text-center">
                <input type="text" name="direccion" placeholder="Direccion" class="form-control mb-3 text-center">
                <input type="text" id="productos" name="productos" placeholder="Productos" class="form-control mb-3 text-center" readonly>
                <select id="productosLista" class="form-select mb-3">
                    <?php $productoClass->mostrarProductos($_SESSION['permisos']); ?>
                </select>
                <input type="number" value="0" id="precio_total" name="precio_total" class="form-control mb-3 text-center" placeholder="Precio Total" readonly>
                <input type="date" name="fecha_compra" class="form-control mb-3 text-center">
            </form>
            <button type="submit" name="agregar_factura" class="btn btn-primary me-5" form="agregar_factura">Agregar Factura</button>
            <button onclick="agregarProducto()" class="btn btn-info ps-5 pe-5">+</button>
        </div>
    </div>

    <?php $facturaClass->MostrarTodos($_SESSION['permisos']); ?>
</div>

<?php include("./includes/footer.php"); ?>