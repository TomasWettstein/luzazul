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
    <section>
        <div class = "cajaportadaproducto">
            <?php foreach ($productoSeleccionado as $key => $value) : ?>
                <h2 class="text-center -titulo"><?= $value['nombre']; ?></h2>
                <div class = "portada">
                    <img src="images/<?= $value['portada']; ?>" class = "img" alt="">
                </div>
                <?php if($value['stock'] == 1) : ?>
                    <h4>Hay Stock</h4>
                <?php else : ?>
                    <h4>No hay stock</h4>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="col-12 col-md-8 offset-md-2 mt-3 row">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-6 mt-3">
                    <img src="images/<?= $value['imagen']; ?>" class = "img ml-3 -full-screen" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <script src="js/fullscreen.js"></script>
    <?php include_once('partials/footer.php'); ?>