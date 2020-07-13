<?php
class Categoria
{
    public $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    //SETTERS

    public function setUserName($nombre)
    {
        $this->nombre = $nombre;
    }
    //GETTERS

    public function getUserName()
    {
        return $this->nombre;
    }
}
