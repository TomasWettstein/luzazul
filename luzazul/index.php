<?php
session_start();
include('loader.php');
$bd;
$consulta = Conexion::consultar("*", "productos");
include_once('partials/header.php');
?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <p class="-titulo">Luz Azul</p>
        <div class="slider" style="width: 100%;">
            <ul>
                <li>
                    <img src="img/caro1.jpg" alt="">
                    <img src="img/caro2.jpg" alt="">
                    <img src="img/caro3.jpg" alt="">
                    <img src="img/caro4.jpg" alt="">
                </li>
                <li>
                    <img src="img/caro5.jpg" alt="">
                    <img src="img/caro6.jpg" alt="">
                    <img src="img/caro7.jpg" alt="">
                    <img src="img/caro8.jpg" alt="">
                </li>
            </ul>
        </div>
    </section>
    <h3 class = "-descrip-index col-12 col-md-8 offset-md-2">Regalería de autora
    Para disfrutar el arte en
    nuestros objetos cotidianos
    te acercamos una variedad de
    productos con ilustraciones
    originales y la mejor relación
    entre precio y calidad.
    Todos los medios de pago.</h3>
    <section>
        <h2 class="-titulo">Nuestros productos</h2>
        <div class="col-12 col-md-12 d-flex flex-row flex-wrap">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-3 mt-3">
                    <h2 class="text-center text-white"><?= $value['nombre']; ?></h2>
                    <a href="mostrarProducto.php?id=<?= $value['id']; ?>"><img src="images/<?= $value['portada']; ?>" class = "col-12" alt=""></a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section>
        <h4 class="text-center text-white">Te gustaron nuestros productos ¿queres realizar una compra?</h4>
        <div class="d-flex col-12 col">
            <button class="btn btn-success col-12 col-sm-4 offset-sm-4 col-md-2 offset-md-5 mb-3"><a class="text-white text-center col-12" href="contacto.php">Contactenos</a></button>
        </div>
    </section>
    <?php
    include_once('partials/footer.php');
    ?>