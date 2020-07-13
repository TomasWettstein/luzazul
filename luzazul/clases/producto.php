<?php
class Producto
{
    public $nombre;
    public $precio;
    public $foto;
    public $categoria_id;

    public function __construct($nombre, $precio, $foto, $categoria_id)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->foto = $foto;
        $this->categoria_id = $categoria_id;
    }

    //SETTERS

    public function setProductName($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
    public function setCategoria($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
    //GETTERS

    public function getProductName()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getFoto()
    {
        return $this->foto;
    }
    public function getCategoria()
    {
        return $this->categoria_id;
    }
}
