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
    var_dump($_POST);
    $datos = json_decode(file_get_contents('php://input'));
    var_dump($datos);

// if (isset($datos->valor->toolBox)) {
// 	include('./responder-toolBox.php');
// 	die();
// }
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

