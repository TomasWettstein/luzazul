<?php
session_start();
require_once('loader.php');
$idProducto = $_GET['id'];
$productoSeleccionado = Conexion::consultar("*", "productos", $idProducto);
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<?php if ($_POST)
{
    $errores = Validador::validarModificarProducto($_POST, $_FILES);
    if (!$errores) 
    {
        $portada = Conexion::armarFoto($_FILES['portada']['name'], $_FILES['portada']['tmp_name']);
        Conexion::modificarProducto($_POST, $idProducto, $portada);
        header('Location: crudProductos.php');
    }
}?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="text-danger text-center">Editar producto</h1>
        <?php foreach ($productoSeleccionado as $key => $value) : ?>
        <form action="editarProducto.php?id=<?= $value['id']; ?>" method="POST" enctype="multipart/form-data" class="-form col-12 col-md-4 offset-md-4 mt-5 d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="<?= $value['nombre'] ?>">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Foto de portada del producto</label>
                <input type="file" name="portada" class="form-control" id="exampleFormControlInput1" placeholder="<?= $value['nombre'] ?>">
                <?php if (isset($errores['portada'])) : ?>
                    <p class="text-danger"> <?= $errores['portada'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlSelect1">Seleccione categoria</label>
                <select name="categoria" class="form-control" id="exampleFormControlSelect1">
                    <option value="1">Bolsos</option>
                    <option value="2">Tazas</option>
                    <option value="3">Jarros termicos</option>
                    <option value="4">Mate listo</option>
                    <option value="5">Porta cosmeticos</option>
                    <option value="6">Bolsas para autos</option>
                    <option value="7">Ofertas</option>
                </select>
            </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-dark text-center col-4 offset-4">Modificar</button>
        </form>
    </section>
    <?php include_once('partials/footer.php'); ?>
    <?php endif; ?>
    <?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
    <?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
    <?php include_once('partials/footer.php'); ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (!$_SESSION) : ?>
<body>
    <?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
    <?php include_once('partials/footer.php'); ?>
    <?php endif; ?>