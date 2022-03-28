<?php 
    include("./Acceso/Producto.php");

    $productoClass = new Producto();

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $lista = $productoClass->buscarProducto($id);

        $nombre = $lista[0];
        $nombre_empresa = $lista[1];
        $precio = $lista[2];
        $disponible = $lista[3];
    }

    if(isset($_POST['editar_producto'])){
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nombre_empresa = $_POST['nombre_empresa'];
        $precio = $_POST['precio'];
        $disponible = isset($_POST['disponible']) ? 1 : 0;

        if($nombre != "" && $precio != "" && $nombre_empresa != ""){
            $productoClass->EditarProducto($nombre, $precio, $nombre_empresa, $disponible, $id);
        }
        
        header("Location: principal.php");
    }

    include("./includes/header.php");
?>

<div class="pt-5 col-md-4 container">
    <form action="editar_producto.php" method="POST" class="pt-5" id="editar_producto">
        <input type="text" name="id" value="<?= $id ?>" style="display: none;" class="form-control mb-3 text-center">
        <input type="text" name="nombre" placeholder="Nombre" value="<?= $nombre ?>" class="form-control mb-3 text-center">
        <input type="text" name="nombre_empresa" placeholder="Nombre Empresa" value="<?= $nombre_empresa ?>" class="form-control mb-3 text-center">
        <input type="number" name="precio" value="<?= $precio ?>" placeholder="Precio" class="form-control mb-3 text-center">
        <div class="form-check mb-3">
        <?php if($disponible){ ?>
            <input id="disponible" class="form-check-input" type="checkbox" name="disponible" value="1" checked>
        <?php }else{ ?>
            <input id="disponible" class="form-check-input" type="checkbox" name="disponible" value="1">
        <?php } ?>
        <label for="disponible" class="form-check-label text-white">Disponible</label>
        </div>
    </form>
    <div class=" text-center">
        <button type="submit" name="editar_producto" class="btn btn-primary" form="editar_producto">Editar Producto</button>
        <a href="./principal.php" class="btn btn-success">Volver</a>
    </div>
</div>

<?php include("./includes/footer.php"); ?>