<?php
class Usuario
{
    public $nombre;
    public $email;
    public $contraseña;

    public function __construct($nombre = null, $email, $contraseña)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->contraseña = $contraseña;
    }

    //SETTERS

    public function setUserName($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setEmail($email)
    {
        $this->email - $email;
    }
    public function setPassword($contraseña)
    {
        $this->contraseña = $contraseña;
    }
    //GETTERS

    public function getUserName()
    {
        return $this->nombre;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword()
    {
        return $this->contraseña;
    }
}
