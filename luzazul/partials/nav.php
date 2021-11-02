<?php $consultaCategoria = Conexion::consultar("*", "categorias"); ?>
<?php if ($_SESSION) : ?>
  <?php if ($_SESSION['is_admin'] === "1") : ?>
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand col-6 text-white" href="index.php">Productos Luz Azul</a>
    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li class="dropdown-item"><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-white" href="contacto.php">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Administrar
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="crudProductos.php">Productos</a></li>
            <li><a class="dropdown-item" href="crudCategorias.php">Categorias</a></li>
          </ul>
        </li>
        <?php if (isset($_SESSION['nombre'])) : ?>
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= $_SESSION['nombre']  ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="dropdown-item"><a href="logout.php">Cerrar sesion</a></li>
          </ul>
        </li>
        <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>
  <?php if ($_SESSION['is_admin'] === "0") : ?>
    <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand col-6 text-white" href="#">Productos Luz Azul</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li class="dropdown-item"><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="contacto.php">Contacto</a>
        </li>
        <?php if (isset($_SESSION['nombre'])) : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= $_SESSION['nombre']  ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a href="logout.php">Cerrar sesion</a></li>
+          </ul>
        </li>
        <?php endif; ?>
    </div>
  </div>
</nav>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
  <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand col-8 text-white" href="#">Productos Luz Azul</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Productos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li class="dropdown-item"><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="contacto.php">Contacto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="login.php">Iniciar Sesion</a>
        </li>
        
    </div>
  </div>
</nav>
  <?php endif; ?>
