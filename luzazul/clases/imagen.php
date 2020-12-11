<?php
class Imagen{
    public $imagen;
    public $producto_id;

    public function __contruct($producto_id)
    {
        $this->producto_id = $producto_id;
    }
    public function setProducto($producto_id)
    {
        $this->producto_id = $producto_id;
    }
    public function getProducto()
    {
        return $this->producto_id;
    }
}