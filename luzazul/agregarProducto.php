<?php
session_start();
require_once('loader.php');
require_once('helpers.php');
$baseDato = Conexion::conectar();
$productos = Conexion::consultar("*", "productos");
$cantidadProductos = count($productos);

$consulta = "SELECT * FROM productos ORDER BY ID DESC LIMIT 1";
$ultimo_id = $baseDato->prepare($consulta);
$ultimo_id->execute();
$ultimo = $ultimo_id->fetch(PDO::FETCH_ASSOC);
$idVerificado = Conexion::verificarUltimoId($ultimo);
$categorias = Conexion::consultar("*", "categorias");
if ($_POST) 
{
    $producto = new Producto($_POST['nombre'],$_FILES['portada'], $_POST['categoria']);
    $errores = Validador::validarProducto($producto);
    $arrayModificado = Conexion::transformarArray($_FILES['arrayImg']);
    $erroresImg = Validador::validarImagenes($arrayModificado);
    if (!$errores && !$erroresImg) 
    {
        $portada = Conexion::armarFoto($_FILES['portada']['name'], $_FILES['portada']['tmp_name']);
        Conexion::agregarProducto($producto, $portada);
        $cantidadImg = count($_FILES['arrayImg']['name']);
        for ($i=0; $i < $cantidadImg ; $i++) { 
            $nuevaImagen = new Imagen($idVerificado);
            $directorio = "images/";
            $archivo = $directorio . basename($_FILES['arrayImg']['name'][$i]);
            $tipoDeArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            $imagen = Conexion::armarFoto($_FILES['arrayImg']['name'][$i], $_FILES['arrayImg']['tmp_name'][$i]);
            /* Tengo que crear esta funcion de abajo para agregar las imagenes a la base de datos*/
            Conexion::agregarImagen($imagen, $idVerificado);
        }
        header('Location: crudProductos.php');
    }
}
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">Agregar producto</h1>
        <form action="agregarProducto.php" method="POST" enctype="multipart/form-data" class="-form col-12 col-md-4 offset-md-4 mt-5 d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value = "" id="nombreproducto" placeholder="Ingrese nombre del producto...">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
                <p class = "text-danger" id = "errorNombre"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Imagen de portada del producto</label>
                <input type="file" name="portada" class="form-control" accept="image/*" value = "" id="portadaproducto">
                <?php if (isset($errores['portada'])) : ?>
                    <p class="text-danger"> <?= $errores['portada'] ?> </p>
                <?php endif ?>
                <p class = "text-danger" id = "errorPortada"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput2">Imagenes del producto</label>
                <input type="file" name="arrayImg[]" multiple = "" class="form-control" accept="image/*" id="imagenesproducto">
                <?php if(isset($erroresImg['imagenes'])) : ?>   
                    <p class = "text-danger"><?= $erroresImg['imagenes'] ?></p>
                <?php endif; ?>
                <p class = "text-danger" id = "errorImagenes"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlSelect1">Seleccione categoria</label>
                <select name="categoria" class="form-control" id="categoriaproducto">
                <option value="" selected disabled>Seleccione una categoria</option>
                <!--Hacer foreach para recorrer categorias-->
                <?php foreach($categorias as $key => $categoria): ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                <?php endforeach; ?>
                </select>
                <p class = "text-danger" id = "errorCategoria"></p>
            </div>
            <button type="submit" class="btn btn-dark text-center col-4 offset-4">Agregar</button>
        </form>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
    <script src="js/validarProducto.js"></script>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
    <footer class = "footer">Copyright © 2021 Tomas Martín Fernandez Wettstein - Todos los derechos reservados.</footer>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section>
        <h1 class="-titulo">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>