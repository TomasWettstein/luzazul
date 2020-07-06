
<?php $consultaCategoria = Conexion :: consultar("*", "categorias"); ?>

<?php if ($_SESSION) : ?>

<?php if($_SESSION['is_admin']=== "1")  :?>
<nav class="navbar navbar-expand-lg  _nav">
  <a class="navbar-brand text-danger col-7" href="#">Productos Luz Azul</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon">   
    <img src="img/menu.png" class = "_boton_menu" alt="">
</span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-danger" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
            <a href="mostrarCategoria.php?id=<?=$value['id'];?>" class="dropdown-item text-danger"><?= $value['nombre'];?></a>
          <?php endforeach; ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="#">Contactenos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Administrar
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-danger" href="crudProductos.php">Productos</a>
        </div>
      </li>
      <?php if (isset($_SESSION['nombre'])) : ?>
        <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['nombre'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-danger" href="logout.php">Cerrar sesion</a>
        
        </div>
      </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<?php endif; ?>

<?php if($_SESSION['is_admin']=== "0")  :?>

<nav class="navbar navbar-expand-lg  _nav">
  <a class="navbar-brand text-danger col-8" href="#">Productos Luz Azul</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon">   
    <img src="img/menu.png" class = "_boton_menu" alt="">
</span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-danger" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
            <a href="mostrarCategoria.php?id=<?=$value['id'];?>" class="dropdown-item text-danger"><?= $value['nombre'];?></a>
          <?php endforeach; ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="#">Contactenos</a>
      </li>
      <?php if (isset($_SESSION['nombre'])) : ?>
        <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['nombre'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item text-danger" href="logout.php">Cerrar sesion</a>
        
        </div>
      </li>
          <?php endif; ?>
    </ul>
  </div>
</nav>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
  <nav class="navbar navbar-expand-lg  _nav">
  <a class="navbar-brand text-danger col-8" href="#">Productos Luz Azul</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon">   
    <img src="img/menu.png" class = "_boton_menu" alt="">
</span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-danger" href="index.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link text-danger  dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Productos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
            <a href="mostrarCategoria.php?id=<?=$value['id'];?>" class="dropdown-item text-danger"><?= $value['nombre'];?></a>
          <?php endforeach; ?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-danger" href="#">Contactenos</a>
      </li>
          <li class="nav-item">
            <a class="nav-link text-danger" href="login.php">Inicia Sesión</a>
          <li class="nav-item">
            <a class="nav-link text-danger" href="registro.php">Registro</a>
          </li>
    </ul>
  </div>
</nav>
        <?php endif;?>
