<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion :: conectar();
if ($_POST) {
  $usuario = new Usuario($_POST['nombre'] = null, $_POST['email'], $_POST['contraseña']);
  $errores = Validador :: validarLogin($usuario);
  if (!$errores) {
      Conexion :: iniciarSesion($usuario);
      // crearCookies($_POST);
      // var_dump($_SESSION);exit;
      header('Location: index.php');
      exit;
  }
}
include_once('partials/header.php');
?>

<body> 
<?php
include_once('partials/nav.php');
?>
<section class = "col- 12 col-md-12">
    <h2 class = "text-center text-danger">Iniciar sesion</h2>
<form action = "login.php" method="POST" class = "col-12 col-md-4 offset-md-4 mt-5 _form_login d-flex flex-column " >
  <div class="form-group d-flex flex-column">
    <label for="exampleInputEmail1" class = "text-danger d-flex ">Escriba su E-mail</label>
    <input type="email" class="form-control d-flex" name = "email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <?php if (isset($errores['email'])) : ?>
        <p class = "text-danger">  <?= $errores['email'] ?> </p>
        <?php endif ?>
  </div>
  <div class="form-group d-flex flex-column">
    <label for="exampleInputPassword1" class = "text-danger d-flex">Escriba una contraseña</label>
    <input type="password" name = "contraseña" class="form-control" id="exampleInputPassword1">
    <?php if (isset($errores['contraseña'])) : ?>
        <p class = "text-danger">  <?= $errores['contraseña'] ?> </p>
        <?php endif ?>
  </div>
  <button type="submit" class="btn btn-dark text-center col-4 offset-4">Enviar</button>
</form>
</section>



<?php
include_once('partials/footer.php');
?>