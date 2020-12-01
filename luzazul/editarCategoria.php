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
        <h1 class="text-light text-center">Editar Categoría</h1>
        <?php foreach ($categoriaSeleccionada as $key => $value) : ?>
        <form action="editarCategoria.php?id=<?= $value['id']; ?>" method="POST" enctype="multipart/form-data" class="_form_login col-12 col-md-4 offset-md-4 mt-5 _form_login d-flex flex-column  ">
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
    <?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if($_SESSION['is_admin'] === "0") :?>
    <body>
    <?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
    <?php include_once('partials/footer.php'); ?>

<?php endif; ?>
<?php endif; ?>
<?php if(!$_SESSION) :?>
    <body>
    <?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
    <?php include_once('partials/footer.php'); ?>
<?php endif; ?>