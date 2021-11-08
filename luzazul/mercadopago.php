<?php 
        $categoria = "SELECT categorias.precio FROM categorias
        INNER JOIN productos ON productos.categoria_id = categorias.id
        WHERE  productos.id = $id_producto";
        $query1 = $bd->prepare($categoria);
        $query1->execute();
        $precioCategoria = $query1-> fetchAll(PDO :: FETCH_ASSOC);

        $nombreProducto = "SELECT nombre FROM productos WHERE id = $id_producto";
        $query2 = $bd->prepare($nombreProducto);
        $query2->execute();
        $nombre = $query2-> fetchAll(PDO :: FETCH_ASSOC);
        //Seccion MercadoPago
        // SDK de Mercado Pago
        require __DIR__ .  '/vendor/autoload.php';
        // Agrega credenciales
        MercadoPago\SDK::setAccessToken('TEST-6183583317540715-110716-f01b14419e45300c86d30d57e4f3723d-1014232291');
        // SDK de Mercado Pago
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = $nombre[0]['nombre'];
        $item->quantity = 1;
        $item->unit_price = $precioCategoria[0]['precio'];
        $preference->items = array($item);
        $preference->save();
?>


