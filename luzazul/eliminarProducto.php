<?php
session_start();
require_once('loader.php');
$id_producto = $_GET["id"];
$productoSeleccionado = Conexion::consultar("*", "productos", $id_producto);
include_once('partials/header.php')
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<?php if (isset($_POST)) 
{
    Conexion::eliminarProducto($id_producto);
    header('Location: crudProductos.php');
}; ?>
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