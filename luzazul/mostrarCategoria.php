<?php
session_start();
require_once('loader.php');
$id_categoria = $_GET["id"];
$categoriaSeleccionada = Conexion::consultarProductosPorCategoria("*", "productos", $id_categoria);
include_once('partials/header.php');
?>

<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <div class="col-12 col-md-12 d-flex flex-row flex-wrap">
            <?php foreach ($categoriaSeleccionada as $key => $value) : ?>
                <div class="col-12 col-md-3">
                    <h2 class="text-center text-white"><?= $value['nombre']; ?></h2>
                    <a href="mostrarProducto.php?id=<?= $value['id']; ?>"><img src="images/<?= $value['portada']; ?>" class = "col-12" alt=""></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include_once('partials/footer.php'); ?>