<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion::conectar();
if ($_POST) 
{
  $usuario = new Usuario($_POST['nombre'], $_POST['email'], $_POST['contraseña']);
  $errores = Validador::validarRegistro($usuario, $_POST['contraseñaRep']);
  if (!$errores) 
  {
    Conexion::registrarUsuario($usuario);
    header('Location: login.php');
    exit;
  }
}
include_once('partials/header.php');
?>
<body>
  <?php include_once('partials/nav.php'); ?>
  <section class="col- 12 col-md-12">
    <h2 class="text-center text-danger">Registro</h2>
    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <form action="registro.php" method="POST" class="col-12 col-md-4 offset-md-4 mt-5 -form-login d-flex flex-column ">
      <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1" class="text-danger d-flex ">Escriba nombre de usuario</label>
        <input type="text" class="form-control d-flex" placeholder="Ingrese un nuevo nombre de usuario..." name="nombre" id="nombre">
        <p id="pUsuario"></p>
        <?php if (isset($errores['nombre'])) : ?>
          <p class="text-danger"> <?= $errores['nombre'] ?> </p>
        <?php endif ?>
      </div>
      <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1" class="text-danger d-flex ">Escriba su E-mail</label>
        <input type="email" class="form-control d-flex" placeholder="Ingrese un email..." name="email" id="email" aria-describedby="emailHelp">
        <p id="pEmail"></p>
        <?php if (isset($errores['email'])) : ?>
          <p class="text-danger"> <?= $errores['email'] ?> </p>
        <?php endif ?>
      </div>
      <div class="form-group d-flex flex-column">
        <label for="exampleInputPassword1" class="text-danger d-flex">Escriba una contraseña</label>
        <input type="password" class="form-control" placeholder="Ingrese una contraseña..." name="contraseña" id="contraseña">
        <p id="pPass"></p>
        <?php if (isset($errores['contraseña'])) : ?>
          <p class="text-danger"> <?= $errores['contraseña'] ?> </p>
        <?php endif ?>
      </div>
      <div class="form-group d-flex flex-column">
        <label for="exampleInputPassword1" class="text-danger d-flex">Repita la contraseña</label>
        <input type="password" class="form-control" placeholder="Repita la contraseña..." name="contraseñaRep" id="exampleInputPassword1">
        <?php if (isset($errores['contraseñaRep'])) : ?>
          <p class="text-danger"> <?= $errores['contraseñaRep'] ?> </p>
        <?php endif ?>
      </div>
      <button type="submit" class="btn btn-dark text-center col-4 offset-4">Enviar</button>
      <span class="text-primary">¿Ya tenes una cuenta? <a href="login.php">Inicia sesion</a></span>

    </form>
  </section>


<script src="js/registro.js"></script>
<?php include_once('partials/footer.php'); ?>