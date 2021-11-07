<?php
session_start();
require_once('loader.php');
$id_producto = $_GET["id"];
$productoSeleccionado = Conexion::consultar("*", "productos", $id_producto);
$sqlImagenes = "SELECT * FROM imagenes WHERE producto_id = $id_producto";
$query = $bd->prepare($sqlImagenes);
$query->execute();
$consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);

$categoria = "SELECT categorias.precio FROM categorias
INNER JOIN productos ON productos.categoria_id = categorias.id
WHERE  productos.id = $id_producto";
$query2 = $bd->prepare($categoria);
$query2->execute();
$precioCategoria = $query2-> fetchAll(PDO :: FETCH_ASSOC);
//Seccion MercadoPago
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-6183583317540715-110716-f01b14419e45300c86d30d57e4f3723d-1014232291');
?>
<?php
include_once('partials/header.php');
?>

<body>
    <?php include_once('partials/nav.php'); ?>
    <section>
        <div class = "cajaportadaproducto">
            <?php foreach ($productoSeleccionado as $key => $value) : ?>
                <?php // SDK de Mercado Pago
                    $preference = new MercadoPago\Preference();

                    // Crea un ítem en la preferencia
                    $item = new MercadoPago\Item();
                    $item->title = $value['nombre'];
                    $item->quantity = 1;
                    $item->unit_price = $precioCategoria[0]['precio'];
                    $preference->items = array($item);
                    $preference->purpose = 'wallet_purchase';
                    $preference->save(); 
                ?>
                <h2 class="text-center -titulo"><?= $value['nombre']; ?></h2>
                <div>
                    <div class = "portada text-center">
                        <img src="images/<?= $value['portada']; ?>" class = "img" alt="">
                        <?php if($value['stock'] == 1) : ?>
                        <h2 class="text-white ">Hay Stock de este producto!!</h2>
                        <?php else : ?>
                            <h2 class="text-danger">No hay stock</h2>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="pagar"></div>
                    </div>
                </div>
             
           
        </div>
        <div class="col-12 col-md-8 offset-md-2 mt-3 row">
            <?php foreach ($consulta as $key => $value) : ?>
                <div class="col-12 col-md-6 mt-3">
                    <img src="images/<?= $value['imagen']; ?>" class = "img ml-3 -full-screen" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <script src="js/fullscreen.js"></script>
    <?php include_once('partials/footer.php'); ?>
    <script>
// Agrega credenciales de SDK
const mp = new MercadoPago('TEST-967f4103-021d-4de6-9bfd-aceddc6d75b4', {
    locale: 'es-AR'
});

  // Inicializa el checkout
  mp.checkout({
        preference: {
            id: "<?php echo $preference->id; ?>"
        },
        render: {
            container: '.pagar', // Indica el nombre de la clase donde se mostrará el botón de pago
            label: 'Comprar', // Cambia el texto del botón de pago (opcional)
        }
    });
</script>