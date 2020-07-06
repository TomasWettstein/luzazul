<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion :: conectar();
$consulta = Conexion :: consultar("*", "productos");
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if($_SESSION['is_admin']=== "1")  :?>
  <body> 
    <?php
    include_once('partials/nav.php');
    ?>
    <section class = "col- 12 col-md-12">
<h1 class = "col-12 text-center">Administrar productos</h1>
<button class = "btn btn-primary col-12 col-md-2 offset-md-5"><a class = "text-white" href="agregarProducto.php">Agregar Producto</a></button>
<table class="table col-12 col-md-8 offset-md-2 mt-5">
    <thead class="col-12">
        <tr>
            <th class = "text-danger" scope="col">#</th>
            <th class = "text-danger" scope="col">Nombre</th>
            <th class = "text-danger" scope="col">precio</th>
            <th class = "text-danger" scope="col">Ver</th>
            <th class = "text-danger" scope="col">Editar</th>
            <th class = "text-danger" scope="col">Eliminar</th>
        </tr>
        </thead>
      <tbody>
        <?php foreach ($consulta as $key => $value) : ?>
          <tr>
            <td class = "text-white"><?= $value['id']; ?></td>
            <td class = "text-white"><?= $value['nombre']; ?></td>
            <td class = "text-white"><?= $value['precio']; ?></td>
            <td class = "text-white"><a href="mostrarProducto.php?id=<?=$value['id'];?>"><ion-icon name="eye-outline"></ion-icon></a></td>
            <td class = "text-white"><ion-icon name="build-outline"></ion-icon></td>
            <td class = "text-white"><ion-icon name="trash-outline"></ion-icon></td>
            <td class = "text-white">
              <a href="../vistas-usuario/editar.php?pregunta=<?= $value['id']; ?>"><i class="fas fa-edit"></i></a>
              <a href="../vistas-usuario/eliminar.php?pregunta=<?= $value['id']; ?>"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
</table>
</section>



<?php
include_once('partials/footer.php');
?>

<?php endif; ?>

<?php if($_SESSION['is_admin']=== "0")  :?>
    <body> 
        <?php
        include_once('partials/nav.php');
        ?>
        <section class = "col- 12 col-md-12">
            <h1 class = "col-12 text-center">No se puede acceder a este sitio.</h1>
        </section>
        <?php
        include_once('partials/footer.php');
        ?>
        <?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
  <body> 
<?php
include_once('partials/nav.php');
?>
<section class = "col- 12 col-md-12">
  <h1 class = "col-12 text-center">No se puede acceder a este sitio.</h1>
</section>
<?php
include_once('partials/footer.php');
?>
<?php endif;?>


