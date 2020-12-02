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
/*Crear una funcion que devuelva retorne 1 si la query anterior da false y que retorno el id + 1*/
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
        /*El problema esta en cuando consulto todos y le sumo uno,  si antesl elimine algun producto como se borra ese id, este sol suma uno al anterior y ya no concuerdan los id
        Abria que hacer un metodo para que cuando se elimine*/
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
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center text-light">Agregar producto</h1>
        <form action="agregarProducto.php" method="POST" enctype="multipart/form-data" class="-form-login col-12 col-md-4 offset-md-4 mt-5 _form_login d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value = "" id="nombre" placeholder="Ingrese nombre del producto...">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
                <p class = "text-danger" id = "errorNombre"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Imagen de portada del producto</label>
                <input type="file" name="portada" class="form-control" accept="image/*" value = "" id="portada">
                <?php if (isset($errores['portada'])) : ?>
                    <p class="text-danger"> <?= $errores['portada'] ?> </p>
                <?php endif ?>
                <p class = "text-danger" id = "errorPortada"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput2">Imagenes del producto</label>
                <input type="file" name="arrayImg[]" multiple = "" class="form-control" accept="image/*" id="imagenes">
                <?php if(isset($erroresImg['imagenes'])) : ?>   
                    <p class = "text-danger"><?= $erroresImg['imagenes'] ?></p>
                <?php endif; ?>
                <p class = "text-danger" id = "errorImagenes"></p>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlSelect1">Seleccione categoria</label>
                <select name="categoria" class="form-control" id="categoria">
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
    <script src="js/validarProducto.js"></script>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section class="col-12 col-md-12">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>