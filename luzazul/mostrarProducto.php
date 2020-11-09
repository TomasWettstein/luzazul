<?php
session_start();
require_once('loader.php');
$id_producto = $_GET["id"];
$productoSeleccionado = Conexion::consultar("*", "productos", $id_producto);
$sqlImagenes = "SELECT * FROM imagenes WHERE producto_id = $id_producto";
$query = $bd->prepare($sqlImagenes);
$query->execute();
$consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
include_once('partials/header.php');
?>

<body>
    <?php include_once('partials/nav.php'); ?>
    <section class = "col-12 col-md-12 d-flex flex-row">
        <div class="col-12 col-md-6 d-flex flex-row flex-wrap mt-4">
            <?php foreach ($productoSeleccionado as $key => $value) : ?>
                <div class="col-12 col-md-12">
                    <h2 class="text-center text-white"><?= $value['nombre']; ?></h2>
                    <img src="images/<?= $value['portada']; ?>" class = "col-12" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-12 col-md-6 d-flex flex-row flex-wrap mt-4">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-6">
                    <img src="images/<?= $value['imagen']; ?>" class = "col-12" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include_once('partials/footer.php'); ?>