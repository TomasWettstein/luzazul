<?php
session_start();
require_once('loader.php');
$id_categoria = $_GET['id'];
$categoriaSeleccionada = Conexion::consultar("*", "categorias", $id_categoria);
include_once('partials/header.php');
?>
<?php if($_SESSION) : ?>
<?php if($_SESSION['is_admin'] === "1" ) :?>
<?php if ($_POST) {
    $errores = Validador::validarEditarCategoria($_POST);
    if (!$errores) {
        Conexion::modificarCategoria($_POST, $id_categoria);
        header('Location: crudCategorias.php');
    }
}
?>
<body>
<?php include_once('partials/nav.php'); ?>
<section>
        <h1 class="text-center -titulo">Editar Categoría</h1>
        <?php foreach ($categoriaSeleccionada as $key => $value) : ?>
        <form action="editarCategoria.php?id=<?= $value['id']; ?>" method="POST" enctype="multipart/form-data" class="-form col-12 col-md-4 offset-md-4 mt-5 d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre de la categoría</label>
                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="<?= $value['nombre'] ?>">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Precio</label>
                <input type="number" name="precio" class="form-control" id="exampleFormControlInput1" placeholder="<?= $value['precio'] ?>">
                <?php if (isset($errores['precio'])) : ?>
                    <p class="text-danger"> <?= $errores['precio'] ?> </p>
                <?php endif ?>
            </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-dark text-center col-4 offset-4">Modificar</button>
        </form>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if($_SESSION['is_admin'] === "0") :?>
    <body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <?php include_once('partials/footer.php'); ?>

<?php endif; ?>
<?php endif; ?>
<?php if(!$_SESSION) :?>
    <body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <?php include_once('partials/footer.php'); ?>
<?php endif; ?>