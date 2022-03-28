<?php 
    include("./Acceso/Producto.php");
    include("./includes/header.php"); 

    $productoClass = new Producto();

    if(isset($_POST['agregar_producto'])){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $nombre_empresa = $_POST['nombre_empresa'];
        $disponible = isset($_POST['disponible']) ? 1 : 0;
        $id_usuario = $_SESSION['permisos'];

        if($nombre != "" && $precio != "" && $nombre_empresa != ""){
            if($productoClass->AgregarProducto($nombre, $precio, $nombre_empresa, $disponible, $id_usuario)){
                $_SESSION['agregado_producto'] = "";
            }else{
                $_SESSION['agregado_producto'] = "No se agrego el producto";
            }
        }else{
            $_SESSION['agregado_producto'] = "No se agrego el producto";
        }
    }
?>

<div class="row p-5">
    <div class="card bg-dark border-info text-white col-md-3 m-5">
        <div class="card-body">
            <form action="principal.php" method="POST">
                <?php 
                    if(isset($_SESSION['agregado_producto'])){
                    ?>
                        <div><?= $_SESSION['agregado_producto'] ?></div>
                <?php 
                    }
                ?>
                <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-3 mt-3 text-center">
                <input type="text" name="nombre_empresa" placeholder="Nombre Empresa" class="form-control mb-3 text-center">
                <input type="number" name="precio" class="form-control mb-3 text-center" placeholder="Precio">
                <div class="form-check mb-3">
                    <input id="disponible" class="form-check-input" type="checkbox" name="disponible" value="1">
                    <label for="disponible" class="form-check-label">Disponible</label>
                </div>
                <div class="text-center">
                    <button type="submit" name="agregar_producto" class="btn btn-primary">Agregar Producto</button>
                </div>
            </form>
        </div>
    </div>

<?php $productoClass->MostrarTodos($_SESSION['permisos']); ?>
</div>

<?php include("./includes/footer.php"); ?>