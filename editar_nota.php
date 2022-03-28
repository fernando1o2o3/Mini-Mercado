<?php 
    include("./Acceso/Nota.php");

    $notaClass = new Nota();

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $lista = $notaClass->buscarNota($id);

        $titulo = $lista[0];
        $descripcion = $lista[1];
        $fecha_realizacion = $lista[2];
    }

    if(isset($_POST['editar_nota'])){
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $fecha_realizacion = $_POST['fecha_realizacion'];

        $notaClass->EditarNota($titulo, $descripcion, $fecha_realizacion, $id);

        header("Location: notas.php");
    }

    include("./includes/header.php");
?>

<div class="pt-5 col-md-4 text-center container">
    <form action="editar_nota.php" method="post" class="pt-5" id="editar_nota">
        <input type="text" name="id" value="<?= $id ?>" style="display: none;" class="form-control mb-3 text-center">
        <input type="text" name="titulo" placeholder="Titulo" value="<?= $titulo ?>" class="form-control mb-3 text-center">
        <input type="text" name="descripcion" placeholder="Descripcion" value="<?= $descripcion ?>" class="form-control mb-3 text-center">
        <input type="date" name="fecha_realizacion" value="<?= $fecha_realizacion ?>" class="form-control mb-3 text-center">
    </form>

    <button type="submit" name="editar_nota" class="btn btn-primary" form="editar_nota">Editar Nota</button>
    <a href="./notas.php" class="btn btn-success">Volver</a>
</div>

<?php include("./includes/footer.php"); ?>