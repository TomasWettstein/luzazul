<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion::conectar();
$consulta = Conexion::consultar("*", "productos");
$categorias = Conexion::consultar("*", "categorias");
if ($_POST) {
    $producto = new Producto($_POST['nombre'], $_POST['precio'], $_FILES, $_POST['categoria']);
    $errores = Validador::validarProducto($producto);
    if (!$errores) {
        $mensaje = [];
        $directorio = "images/";
        $archivo = $directorio . basename($_FILES['foto']['name']);
        $tipoDeArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        //Validar si es una imagen, si devuelve falso, no es imagen y si devuelve informacion es una imagen.
        $checkImage = getimagesize($_FILES['foto']['tmp_name']);
        if ($checkImage != false) {
            $size = $_FILES['foto']['size'];
            if ($size > 1000000) {
                $mensaje['tamaño'] = "El archivo tiene que ser menor que 1mb";
            } else {
                //Validar tipo de imagen
                if ($tipoDeArchivo == 'jpg' || $tipoDeArchivo == 'jpeg' || $tipoDeArchivo == 'png') {
                    //Si se valido el archivo correctamente...
                    $imagen = Conexion::armarFoto($producto->getFoto());
                    Conexion::agregarProducto($producto, $imagen);
                } else {
                    $mensaje['archivo'] = "Ingrese un archivo valido";
                }
            }
        } else {
            $mensaje['imagen'] = "El archivo no es una imagen";
        }


        // header('Location: crudProductos.php');
        // exit;
    }
}
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
    <?php if ($_SESSION['is_admin'] === "1") : ?>

        <body>
            <?php
            include_once('partials/nav.php');
            ?>
            <section class="col- 12 col-md-12">
                <h1 class="col-12 text-center text-danger">Agregar producto</h1>
                <form action="agregarProducto.php" method="POST" enctype="multipart/form-data" class="_form_login col-12 col-md-4 offset-md-4 mt-5 _form_login d-flex flex-column  ">
                    <div class="form-group">
                        <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                        <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1" placeholder="Ingrese nombre del producto...">
                        <?php if (isset($errores['nombre'])) : ?>
                            <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" for="exampleFormControlInput2">Precio del producto</label>
                        <input type="number" name="precio" class="form-control" id="exampleFormControlInput1">
                        <?php if (isset($errores['precio'])) : ?>
                            <p class="text-danger"> <?= $errores['precio'] ?> </p>
                        <?php endif ?>
                    </div>
                    <div class="form-group">
                        <label class="text-danger" for="exampleFormControlInput2">Precio del producto</label>
                        <input type="file" name="foto" class="form-control" id="exampleFormControlInput1">
                        <?php if (isset($errores['foto'])) : ?>
                            <p class="text-danger"> <?= $errores['foto'] ?> </p>
                        <?php endif ?>
                        <?php if (isset($mensaje['tamaño'])) : ?>
                            <p class="text-danger"> <?= $mensaje['tamaño'] ?> </p>
                        <?php endif ?>
                        <?php if (isset($mensaje['error'])) : ?>
                            <p class="text-danger"> <?= $mensaje['error'] ?> </p>
                        <?php endif ?>
                        <?php if (isset($mensaje['archivo'])) : ?>
                            <p class="text-danger"> <?= $mensaje['archivo'] ?> </p>
                        <?php endif ?>
                        <?php if (isset($mensaje['imagen'])) : ?>
                            <p class="text-danger"> <?= $mensaje['imagen'] ?> </p>
                        <?php endif ?>

                    </div>
                    <div class="form-group">
                        <label class="text-danger" for="exampleFormControlSelect1">Seleccione categoria</label>
                        <select name="categoria" class="form-control" id="exampleFormControlSelect1">
                            <option value="1">Bolsos</option>
                            <option value="2">Tazas</option>
                            <option value="3">Jarros termicos</option>
                            <option value="4">Mate listo</option>
                            <option value="5">Porta cosmeticos</option>
                            <option value="6">Bolsas para autos</option>
                            <option value="7">Ofertas</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark text-center col-4 offset-4">Agregar</button>
                </form>
            </section>



            <?php
            include_once('partials/footer.php');
            ?>

        <?php endif; ?>

        <?php if ($_SESSION['is_admin'] === "0") : ?>

            <body>
                <?php
                include_once('partials/nav.php');
                ?>
                <section class="col- 12 col-md-12">
                    <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
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
                <section class="col- 12 col-md-12">
                    <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
                </section>
                <?php
                include_once('partials/footer.php');
                ?>
            <?php endif; ?>