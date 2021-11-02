<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
if ($_POST) 
{
  $email = $_POST['email'];
  $errores = Validador::validarLogin($_POST);
  if (count($errores) == 0) 
  {
    $baseDato = Conexion::conectar();
    $usuario = Conexion::buscarPorEmail($bd, 'usuarios', $email);
    if ($usuario == null) 
    {
      $errores['email'] = "Datos incorrectos verifique...";
    } else
    {
      if (password_verify($_POST['contraseña'], $usuario['contraseña']) === false) 
      {
        $errores['contraseña'] = "Datos incorrectos verifique...";
      } else
      {
        Conexion::seteoUsuario($usuario, $_POST);
        if (Conexion::validarUsuario()) 
        {
          header('location:index.php');
          exit;
        } else 
        {
          header('location:login.php');
          exit;
        }
      }
    }
  }
}
include_once('partials/header.php');
?>

<body>
  <?php
  include_once('partials/nav.php');
  ?>
  <section>
    <h2 class="-titulo">Iniciar sesion</h2>
    <form action="login.php" method="POST" class="col-12 col-md-4 offset-md-4 mt-5 -form d-flex flex-column  ">
      <div class="form-group d-flex flex-column">
        <label for="exampleInputEmail1" class="text-danger d-flex ">Escriba su E-mail</label>
        <input type="email" placeholder="Ingrese su email" class="form-control d-flex" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        <?php if (isset($errores['email'])) : ?>
          <p class="text-danger"> <?= $errores['email'] ?> </p>
        <?php endif ?>
      </div>
      <div class="form-group d-flex flex-column">
        <label for="exampleInputPassword1" class="text-danger d-flex">Escriba su contraseña</label>
        <input type="password" placeholder="Ingrese su contraseña" name="contraseña" class="form-control" id="exampleInputPassword1">
        <?php if (isset($errores['contraseña'])) : ?>
          <p class="text-danger"> <?= $errores['contraseña'] ?> </p>
        <?php endif ?>
      </div>
      <button type="submit" class="btn btn-dark text-center col-4 offset-4">Enviar</button>
    </form>
  </section>
  <?php
  include_once('partials/footer.php');
  ?>