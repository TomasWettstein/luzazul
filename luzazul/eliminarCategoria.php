<?php
session_start();
require_once('loader.php');
$id_categoria = $_GET["id"];
$categoriaSeleccionada = Conexion::consultar("*", "categorias", $id_categoria);
include_once('partials/header.php');
?>
<?php if($_SESSION) :?>
<?php if($_SESSION['is_admin'] === "1") :?>
<?php if (isset($_POST)) 
{
    Conexion::eliminarCategoria($id_categoria);
    header('Location: crudCategorias.php');
}?>

<?php if($_SESSION['is_admin'] === "0") : ?>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php if(!$_SESSION) : ?>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif;?>