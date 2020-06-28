<?php 
class Producto {
    public $nombre;
    public $precio;
    public $categoria_id;

    public function __construct($nombre,$precio,$categoria_id){
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria_id= $categoria_id;
    }

    //SETTERS

    public function setProductName($nombre){
        $this->nombre = $nombre;
    }

    public function setPrecio($precio){
        $this->precio - $precio;
    }
    public function setCategoria($categoria_id){
        $this->categoria_id = $categoria_id;
    }
    //GETTERS

    public function getProductName(){
        return $this->nombre;
    }
    public function getPrecio(){
        return $this->precio;
    }
    public function getCategoria(){
        return $this->categoria_id;
    }
}