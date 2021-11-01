<?php $consultaCategoria = Conexion::consultar("*", "categorias"); ?>

<?php if ($_SESSION) : ?>

  <?php if ($_SESSION['is_admin'] === "1") : ?>
   <div class = "dropdwn">
      <nav>
        <p class = "logo">Productos Luz Azul</p>
          <ion-icon class="toggle" id= "botontoggle" name="reorder-four-outline"></ion-icon>
        <ul class = "listanavhidden" id = "lista">
          <li><a href="index.php" class = "dropitem">Inicio</a></li>
          <li><a href="#" class = "dropitem" id = "productodrop">Productos <ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class = "droplista" id = "droplistaproductos">
              <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li><a href="contacto.php" class = "dropitem">Contacto</a></li>
          <li><a href="#" class = "dropitem" id = "admindrop">Administrar <ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class = "droplista" id = "droplistaadmin">
              <li><a class="" href="crudProductos.php">Productos</a></li>
              <li><a class="" href="crudCategorias.php">Categorías</a></li>
            </ul>
          </li>
          <?php if (isset($_SESSION['nombre'])) : ?>
          <li><a href="#" class = "dropitem" id = "sesiondrop"><?= $_SESSION['nombre']  ?><ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class ="droplista" id = "droplistasesion">
              <li><a href="logout.php">Cerrar sesion</a></li>
            </ul>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  <?php endif; ?>

  <?php if ($_SESSION['is_admin'] === "0") : ?>
    <div class = "dropdwn">
      <nav>
        <p class = "logo">Productos Luz Azul</p>
          <ion-icon class="toggle" id= "botontoggle" name="reorder-four-outline"></ion-icon>
        <ul class = "listanavhidden" id = "lista">
          <li><a href="index.php" class = "dropitem">Inicio</a></li>
          <li><a href="#" class = "dropitem" id = "productodrop">Productos <ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class = "droplista" id = "droplistaproductos">
              <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li><a href="contacto.php" class = "dropitem">Contacto</a></li>
          <?php if (isset($_SESSION['nombre'])) : ?>
          <li><a href="#" class = "dropitem" id = "sesiondrop"><?= $_SESSION['nombre']  ?><ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class ="droplista" id = "droplistasesion">
              <li><a href="logout.php">Cerrar sesion</a>
          </li>
            </ul>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
  <div class = "dropdwn">
      <nav>
        <p class = "logo">Productos Luz Azul</p>
          <ion-icon class="toggle" id= "botontoggle" name="reorder-four-outline"></ion-icon>
        <ul class = "listanavhidden" id = "lista">
          <li><a href="index.php" class = "dropitem">Inicio</a></li>
          <li><a href="#" class = "dropitem" id = "productodrop">Productos <ion-icon name="caret-down-outline"></ion-icon></a>
            <ul class = "droplista" id = "droplistaproductos">
              <?php foreach ($consultaCategoria as $key => $value) : ?>
                <li><a href="mostrarCategoria.php?id=<?= $value['id']; ?>"><?= $value['nombre']; ?></a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <li><a href="contacto.php" class = "dropitem">Contacto</a></li>
          <li><a href="registro.php" class = "dropitem">Registro</a> </li>
          <li><a href="login.php" class = "dropitem">Login</a></li>

        </ul>
      </nav>
    </div>
  <?php endif; ?>
