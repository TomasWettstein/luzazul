<?php
require_once('loader.php');
//Seccion MercadoPago
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-6183583317540715-110716-f01b14419e45300c86d30d57e4f3723d-1014232291');
// SDK de Mercado Pago
$preference = new MercadoPago\Preference();
if ($_POST) {
    echo 'hola';
    var_dump('Hola soy post' ,$_POST);   
}
//    $cantidad = $_POST['cantidad'];
//    $precio = $_POST['precio'];
//    $nombre = $_POST['nombre'];
//    $item = new MercadoPago\Item();
//    $item->title = $nombre;
//    $item->quantity = $cantidad;
//    $item->unit_price = $precio;
//    $preference->items = array($item);
//    $preference->save();
   
// }else{
//     $item = new MercadoPago\Item();
//     $item->title = $nombre[0]['nombre'];
//     $item->quantity = 1;
//     $item->unit_price = $precioCategoria[0]['precio'];
//     $preference->items = array($item);
//     $preference->save();
// }
?>

