<?php
session_start();
require_once('loader.php');
$id_producto = $_GET["id"];
require_once('mercadoPago.php');
$productoSeleccionado = Conexion::consultar("*", "productos", $id_producto);
$sqlImagenes = "SELECT * FROM imagenes WHERE producto_id = $id_producto";
$query = $bd->prepare($sqlImagenes);
$query->execute();
$consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
// $mercadoPago= Conexion::mercadoPago($id_producto, $bd);
?>
<?php
include_once('partials/header.php');
?>

<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <div class = "cajaportadaproducto">
            <?php foreach ($productoSeleccionado as $key => $value) : ?>
                <h2 class="text-center -titulo"><?= $value['nombre']; ?></h2>
                <div>
                    <div class = "portada text-center">
                        <img src="images/<?= $value['portada']; ?>" class = "img" alt="">
                        <?php if($value['stock'] == 1) : ?>
                        <h2 class="text-white ">Hay Stock de este producto!!</h2>
                        <div class="pagar"></div>
                        <?php else : ?>
                            <h2 class="text-danger">No hay stock</h2>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
        </div>
        <div class="col-12 col-md-8 offset-md-2 mt-3 row">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-6 mt-3">
                    <img src="images/<?= $value['imagen']; ?>" class = "img ml-3 -full-screen" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include_once('partials/footer.php'); ?>
