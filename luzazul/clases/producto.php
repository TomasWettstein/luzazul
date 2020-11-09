<?php
class Producto
{
    public $nombre;
    public $portada;
    public $categoria_id;

    public function __construct($nombre, $portada,  $categoria_id)
    {
        $this->nombre = $nombre;
        $this->portada = $portada;
        $this->categoria_id = $categoria_id;
    }

    //SETTERS

    public function setProductName($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setPortada($portada)
    {
        $this->portada = $portada;
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
    public function getPortada()
    {
        return $this->portada;
    }
    public function getCategoria()
    {
        return $this->categoria_id;
    }
}
