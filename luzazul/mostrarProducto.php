<?php
session_start();
require_once('loader.php');
$id_producto = $_GET["id"];
$productoSeleccionado = Conexion::consultar("*", "productos", $id_producto);
$sqlImagenes = "SELECT * FROM imagenes WHERE producto_id = $id_producto";
$query = $bd->prepare($sqlImagenes);
$query->execute();
$consulta = $query->fetchAll(PDO::FETCH_ASSOC);

$precio = "SELECT categorias.precio FROM categorias INNER JOIN productos on productos.categoria_id = categorias.id  WHERE productos.id = $id_producto";
$query2 = $bd->prepare($precio);
$query2->execute();
$precioProducto = $query2->fetchAll((PDO::FETCH_ASSOC));

$categoria = "SELECT categorias.precio FROM categorias
INNER JOIN productos ON productos.categoria_id = categorias.id
WHERE  productos.id = $id_producto";
$query1 = $bd->prepare($categoria);
$query1->execute();
$precioCategoria = $query1-> fetchAll(PDO :: FETCH_ASSOC);

$nombreProducto = "SELECT nombre FROM productos WHERE id = $id_producto";
$query2 = $bd->prepare($nombreProducto);
$query2->execute();
$nombre = $query2-> fetchAll(PDO :: FETCH_ASSOC);
require_once('productos.php');
include_once('partials/header.php');
?>

<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <div class="cajaportadaproducto">
            <?php foreach ($productoSeleccionado as $key => $value) : ?>
                <h2 class="text-center -titulo"><?= $value['nombre']; ?></h2>
                <div>
                    <div class="portada text-center">
                        <img src="images/<?= $value['portada']; ?>" class="img" alt="">
                        <?php if ($value['stock'] == 1) : ?>
                            <h2 class="text-white ">Hay Stock de este producto!!</h2>
                            <h4 class="text-white">$<?= $precioProducto[0]['precio']; ?></h4>
                            <form action="" id="form" method="POST">
                                <select name="cantidad" id="select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <input type="hidden" name="nombre" value="<?= $value['nombre']; ?>">
                                <input type="hidden" name="precio" value="<?= $precioProducto[0]['precio']; ?>">
                            </form>
                            <div id="btn" class="pagar"></div>

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
                    <img src="images/<?= $value['imagen']; ?>" class="img ml-3 -full-screen" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include_once('partials/footer.php'); ?>