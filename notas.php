<?php 
    include("./Acceso/Nota.php");
    include("./includes/header.php"); 

    $notaClass = new Nota();

    if(isset($_POST['agregar_nota'])){
        $titulo = $_POST['titulo'];
        $fecha_realizacion = $_POST['fecha_realizacion'];
        $descripcion = $_POST['descripcion'];
        $id_usuario = $_SESSION['permisos'];

        if($titulo != "" && $fecha_realizacion != "" && $descripcion != ""){
            if($notaClass->AgregarNota($titulo, $descripcion, $fecha_realizacion, $id_usuario)){
                $_SESSION['agregado_nota'] = "";
            }else{
                $_SESSION['agregado_nota'] = "No se agrego la nota";
            }
        }else{
            $_SESSION['agregado_nota'] = "No se agrego la nota";
        }
    }
?>
<div class="row p-5 text-center">
    <div class="card bg-dark border-info text-white col-md-3 m-5">
        <div class="card-body">
            <form action="notas.php" method="post">
                <?php 
                    if(isset($_SESSION['agregado_nota'])){
                    ?>
                        <div><?= $_SESSION['agregado_nota'] ?></div>
                <?php 
                    }
                ?>
                <input type="text" name="titulo" placeholder="Titulo" class="form-control mb-3 mt-3 text-center">
                <input type="text" name="descripcion" placeholder="Descripcion" class="form-control mb-3 text-center">
                <input type="date" name="fecha_realizacion" class="form-control mb-3 text-center">
                <button type="submit" name="agregar_nota" class="btn btn-primary">Agregar Nota</button>
            </form>
        </div>
    </div>

    <?php $notaClass->MostrarTodos($_SESSION['permisos']); ?>
</div>

<?php include("./includes/footer.php"); ?>