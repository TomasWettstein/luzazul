<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion::conectar();
$consulta = Conexion::consultar("*", "productos");
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
  <section class="col- 12 col-md-12">
    <h1 class="col-12 text-light text-center">Administrar productos</h1>
    <button class="btn btn-primary col-12 col-md-2 offset-md-5"><a class="text-white" href="agregarProducto.php">Agregar Producto</a></button>
    <table class="table col-12 col-md-8 offset-md-2 mt-5 table-hover">
      <thead class="col-12">
        <tr>
          <th class="text-light" scope="col">#</th>
          <th class="text-light" scope="col">Nombre</th>
          <th class="text-light" scope="col">Ver</th>
          <th class="text-light" scope="col">Editar</th>
          <th class="text-light" scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($consulta as $key => $value) : ?>
        <tr>
          <td class="text-white"><?= $value['id']; ?></td>
          <td class="text-white"><?= $value['nombre']; ?></td>
          <td class="text-white"><a href="mostrarProducto.php?id=<?= $value['id']; ?>"><ion-icon name="eye-outline"></ion-icon></a></td>
          <td class="text-white"><a href="editarProducto.php?id=<?= $value['id']; ?>"><ion-icon name="build-outline"></ion-icon></a></td>
          <td class="text-white"><a onclick="return confirm('¿Estas seguro que queres eliminar este producto?')" href="eliminarProducto.php?id=<?= $value['id']; ?>"><ion-icon name="trash-outline"></ion-icon></a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
  <?php include_once('partials/footer.php'); ?>
  <?php endif; ?>
  <?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
  <section class="col- 12 col-md-12 bg-danger">
    <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
  </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
<body>
<?php include_once('partials/nav.php'); ?>
  <section class="col- 12 col-md-12 bg-danger">
    <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
  </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>