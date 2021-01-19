<?php
session_start();
include('loader.php');
$bd;
$consulta = "SELECT * FROM productos";
$sentencia = $bd->prepare($consulta);
$sentencia->execute();
$productos = $sentencia->fetchAll();
$articulosXPagina = 4;
$totalProductos = $sentencia->rowCount();
$paginas = ceil($totalProductos / 4 );
include_once('partials/header.php');
?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <p class="-titulo">Luz Azul</p>
        <?php if(!$_GET){
            header('Location:index.php?pagina=1');
        }
        if($_GET['pagina'] > $paginas || $_GET['pagina'] <= 0){
            header('Location:index.php?pagina=1');
        }
        $iniciar = ($_GET['pagina'] - 1) * $articulosXPagina;
        $sqlProductos = "SELECT * FROM productos LIMIT :iniciar,:narticulos";
        $sentenciaProductos = $bd->prepare($sqlProductos);
        $sentenciaProductos->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
        $sentenciaProductos->bindParam(':narticulos', $articulosXPagina, PDO::PARAM_INT);
        $sentenciaProductos->execute();
        $cantidadProductos = $sentenciaProductos->fetchAll();
        ?>
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
    para disfrutar el arte en
    nuestros objetos cotidianos
    te acercamos una variedad de
    productos con ilustraciones
    originales y la mejor relación
    entre precio y calidad.
    Todos los medios de pago.</h3>
    <section>
        <h2 class="-titulo">Nuestros productos</h2>
        <div class="col-12 col-md-12 d-flex flex-row flex-wrap">
            <?php foreach ($cantidadProductos as $key => $value) : ?>
                <div class="col-12 col-md-3 mt-3">
                    <h2 class="text-center text-white"><?= $value['nombre']; ?></h2>
                    <a href="mostrarProducto.php?id=<?= $value['id']; ?>"><img src="images/<?= $value['portada']; ?>" class = "col-12" alt=""></a>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?= $_GET['pagina'] - 1 ?>">Anterior</a></li>
                <?php for($i = 0; $i < $paginas; $i++ ): ?>
                <li class="page-item <?= $_GET['pagina'] == $i + 1 ? 'active' : '' ?>"><a class="page-link" href="index.php?pagina=<?= $i + 1 ?>"><?= $i + 1 ?></a></li>
                <?php endfor; ?>
                <li class="page-item <?= $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?= $_GET['pagina'] + 1 ?>">Siguiente</a></li>
            </ul>
        </nav>
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