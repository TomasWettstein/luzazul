<?php session_start();
require_once('helpers.php');
require_once('loader.php');
$conexion = Conexion::conectar();
if($_POST)
{
    $categoria = new Categoria($_POST['nombre'], $_POST['precio']);
    $errores = Validador::validarCategoria($categoria);
    if (!$errores) 
    {
        Conexion::agregarCategoria($categoria);
        header('Location: crudCategorias.php');
    }
}
include_once('partials/header.php');
?>
<?php if($_SESSION) :?>
<?php if($_SESSION['is_admin'] === "1") :?>

<body>
<?php include_once('partials/nav.php');?>
<section>
        <h1 class="-titulo">Agregar categoria</h1>
        <form action="agregarCategoria.php" method="POST" class="_form_login col-12 col-md-4 offset-md-4 mt-5 -form d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value = "" id="exampleFormControlInput1" placeholder="Ingrese nombre del producto...">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Precio</label>
                <input type="number" name="precio" class="form-control" value = "" id="exampleFormControlInput1" placeholder="Ingrese nombre del producto...">
                <?php if (isset($errores['precio'])) : ?>
                    <p class="text-danger"> <?= $errores['precio'] ?> </p>
                <?php endif ?>
            </div>
            <button type="submit" class="btn btn-dark text-center col-4 offset-4">Agregar</button>
        </form>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if($_SESSION['is_admin'] === 0) :?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
<?php include_once('partials/footer.php'); ?>

<?php endif;?>
<?php endif; ?>
<?php if (!$_SESSION) :?>
    <body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <?php include_once('partials/footer.php'); ?>
<?php endif; ?>
