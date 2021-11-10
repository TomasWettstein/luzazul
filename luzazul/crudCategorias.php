<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion::conectar();
$consulta = Conexion::consultar("*", "categorias");
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">Administrar categorías</h1>
        <a class="text-dark" href="agregarCategoria.php"><button class="btn btn-primary col-12 col-md-2 offset-md-5">Agregar Categoria</button></a>
        <table class="table col-12 col-md-8 offset-md-2 mt-5 table-hover">
            <thead class="col-8 col-md-12">
                <tr>
                    <th class="text-dark" scope="col">#</th>
                    <th class="text-dark" scope="col">Nombre</th>
                    <th class="text-dark" scope="col">Precio</th>
                    <th class="text-dark" scope="col">Editar</th>
                    <th class="text-dark" scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consulta as $key => $value) : ?>
                <tr>
                    <td class="text-dark"><?= $key + 1; ?></td>
                    <td class="text-dark"><?= $value['nombre']; ?></td>
                    <td class="text-dark">$<?= $value['precio']; ?></td>
                    <td class="text-dark"><a href="editarCategoria.php?id=<?= $value['id']; ?>"><ion-icon name="build-outline"></ion-icon></a></td>
                    <td class="text-dark"><a onclick="return confirm('¿Estas seguro que queres eliminar esta categoria?')" href="eliminarCategoria.php?id=<?= $value['id']; ?>"><ion-icon name="trash-outline"></ion-icon></a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
<?php include_once('partials/footer.php');?>
<?php endif;?>
<?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <?php include_once('partials/footer.php'); ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php if (!$_SESSION) : ?>
<body>
  <?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
  <?php include_once('partials/footer.php'); ?>
<?php endif; ?>


