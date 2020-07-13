<?php
session_start();
include('loader.php');
$bd;
$consulta = Conexion::consultar("*", "productos");
include_once('partials/header.php');
?>

<body>
    <?php
    include_once('partials/nav.php');
    ?>
    <section>
        <p class="_titulo_index">Luz Azul</p>


        <div class="slider">
            <ul>
                <li><img src="img/caro1.jpeg" alt=""></li>
                <li><img src="img/caro2.jpeg" alt=""></li>
                <li><img src="img/caro3.jpeg" alt=""></li>

            </ul>
        </div>

    </section>
    <section>
        <h2 class="_titulo_index">Nuestros productos</h2>
        <div class="col-12 col-md-12 d-flex flex-row flex-wrap">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-3">
                    <h5 class="text-center text-danger"><?= $value['nombre']; ?></h5>
                    <img src="images/<?= $value['foto']; ?>" style="width: 100%;" alt="">
                    <h4 class="text-center text-success">$<?= $value['precio']; ?></h6>
                </div>
            <?php endforeach; ?>
        </div>

    </section>
    <section>
        <h4 class="text-center text-dark">Te gustaron nuestros productos ¿queres realizar una compra?</h4>
        <div class="d-flex col-12 col">

            <button class="btn btn-success col-12 col-sm-4 offset-sm-4 col-md-2 offset-md-5 mb-3"><a class="text-white text-center col-12" href="#">Contactenos</a></button>

        </div>
    </section>

    <?php
    include_once('partials/footer.php');
    ?>