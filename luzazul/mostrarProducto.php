<?php
session_start();
require_once('loader.php');
$id_producto=$_GET["id"];
$productoSeleccionado = Conexion :: consultar("*", "productos", $id_producto);
include_once('partials/header.php');
?>
<body> 
    <?php
    include_once('partials/nav.php');
    ?>
    <section>
    <div class="col-12 col-md-12 d-flex flex-row flex-wrap">
        <?php foreach ($productoSeleccionado as $key => $value) :?>
            <div class="col-12 col-md-6 offset-md-3">
                <h5 class="text-center text-danger"><?= $value['nombre']; ?></h5>
                <img src="images/<?= $value['foto'];?>" style="width: 100%;" alt="">
                <h4 class="text-center" >$<?= $value['precio']; ?></h6>
            </div>
        <?php endforeach; ?>
    </div>
    </section>





<?php
include_once('partials/footer.php');
?>