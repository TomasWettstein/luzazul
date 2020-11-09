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
var_dump($ultimo);
/*Crear una funcion que devuelva retorne 1 si la query anterior da false y que retorno el id + 1*/
    $idFinal = $ultimo['id'] + 1;

$categorias = Conexion::consultar("*", "categorias");
if ($_POST) 
{
    $producto = new Producto($_POST['nombre'],$_FILES['portada'], $_POST['categoria']);
    $errores = Validador::validarProducto($producto);
    if (!$errores) 
    {
        $portada = Conexion::armarFoto($_FILES['portada']['name'], $_FILES['portada']['tmp_name']);
        Conexion::agregarProducto($producto, $portada);
        /*El problema esta en cuando consulto todos y le sumo uno,  si antesl elimine algun producto como se borra ese id, este sol suma uno al anterior y ya no concuerdan los id
        Abria que hacer un metodo para que cuando se elimine*/
        $cantidadImg = count($_FILES['imagen']['name']);
        for ($i=0; $i < $cantidadImg ; $i++) { 
            $nuevaImagen = new Imagen($idFinal);
            $directorio = "images/";
            $archivo = $directorio . basename($_FILES['imagen']['name'][$i]);
            $tipoDeArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            $imagen = Conexion::armarFoto($_FILES['imagen']['name'][$i], $_FILES['imagen']['tmp_name'][$i]);
            /* Tengo que crear esta funcion de abajo para agregar las imagenes a la base de datos*/
            Conexion::agregarImagen($imagen, $idFinal);
        }
    }
    header('Location: crudProductos.php');
}
include_once('partials/header.php');
?>
<?php if ($_SESSION) : ?>
<?php if ($_SESSION['is_admin'] === "1") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12">
        <h1 class="col-12 text-center text-light">Agregar producto</h1>
        <form action="agregarProducto.php" method="POST" enctype="multipart/form-data" class="_form_login col-12 col-md-4 offset-md-4 mt-5 _form_login d-flex flex-column  ">
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value = "" id="exampleFormControlInput1" placeholder="Ingrese nombre del producto...">
                <?php if (isset($errores['nombre'])) : ?>
                    <p class="text-danger"> <?= $errores['nombre'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput1">Imagen de portada del producto</label>
                <input type="file" name="portada" class="form-control" value = "" id="exampleFormControlInput1">
                <?php if (isset($errores['portada'])) : ?>
                    <p class="text-danger"> <?= $errores['portada'] ?> </p>
                <?php endif ?>
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlInput2">Fotos del producto</label>
                <input type="file" name="imagen[]" multiple = "" class="form-control" id="exampleFormControlInput1">
                    <p class="text-danger" id = "err"></p>
   
            </div>
            <div class="form-group">
                <label class="text-danger" for="exampleFormControlSelect1">Seleccione categoria</label>
                <select name="categoria" class="form-control" id="exampleFormControlSelect1">
                <!--Hacer foreach para recorrer categorias-->
                <?php foreach($categorias as $key => $categoria): ?>
                    <option value="<?= $categoria['value'] ?>"><?= $categoria['nombre'] ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-dark text-center col-4 offset-4">Agregar</button>
        </form>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php if ($_SESSION['is_admin'] === "0") : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section class="col- 12 col-md-12 bg-danger">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>
<?php endif; ?>
<?php if (!$_SESSION) : ?>
<body>
<?php include_once('partials/nav.php'); ?>
    <section class="col-12 col-md-12 bg-danger">
        <h1 class="col-12 text-center">No se puede acceder a este sitio.</h1>
    </section>
<?php include_once('partials/footer.php'); ?>
<?php endif; ?>