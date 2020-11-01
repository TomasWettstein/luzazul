<?php
class Categoria
{
    public $nombre;
    public $precio;

    public function __construct($nombre, $precio)
    {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    //SETTERS

    public function setCategoriaNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    //GETTERS

    public function getCategoriaNombre()
    {
        return $this->nombre;
    }
    public function setPrecio()
    {
        $this->precio = $precio;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
}
