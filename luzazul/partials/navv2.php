<?php $consultaCategoria = Conexion::consultar("*", "categorias"); ?>
<?php if($_SESSION) : ?>
    <?php if($_SESSION['is_admin'] === "1") : ?>
    <header>
        <div class="menubar">
            <a href="#" class="btnmenu"><ion-icon class="toggle" id= "botontoggle" name="reorder-four-outline"></ion-icon>Menu</a>
        </div>
        <nav id="nav">
            <a href="#">Productos Luz azul</a>
            <ul>
                <li><a href="#">Inicio</a></li> 
                <li><a href="#">Productos</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Administrar</a></li>
                <?php if (isset($_SESSION['nombre'])) : ?>
                <li><a href="#"><?= $_SESSION['nombre']  ?></ion-icon></a>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <?php endif;?>
    <?php if($_SESSION['is_admin'] === 0) : ?>

    <?php endif; ?>
<?php endif; ?> 
<?php if(!$_SESSION) : ?>

<?php endif; ?>