<?php
class Validador{
    public static function validarRegistro($usuario, $contraseñaRep)
    {
        $errores = [];
        $verificar = Conexion :: consultar("*" , "usuarios");
        $nombre = trim($usuario->getUserName());
        if (empty($nombre)) {
            $errores['nombre'] = "El nombre de usuario no puede estar vacio";
        } foreach($verificar as $key => $value){
            if($value['nombre'] == $nombre){
                $errores['nombre'] = "El usuario ya se encuentra registrado";
            }
        }
        $email = trim($usuario-> getEmail());
        if(empty($email)){
            $errores['email'] = "Debe ingresar un email";
        }  elseif (!filter_var($usuario-> getEmail(), FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "El email no es valido";
        } foreach($verificar as $key=> $value){
            if($email == $value['email']){
                $errores['email'] = "El email ya se encuentra registrado";
            }
        }
        $contraseña = trim($usuario-> getPassword());
        if(empty($contraseña)){
            $errores['contraseña'] = "Debe ingresar una contraseña";
        } elseif(!is_numeric($contraseña) && !is_string($contraseña)){
            $errores['contraseña'] = "La contraseña debe contenedor letras y numeros";
        } elseif (strlen($contraseña < 6)) {
            $errores['contraseña'] = "La constraseña debe tener un minimo de 6 caracteres";
        }
        $passwordRepeat = trim($contraseñaRep);
        if ($contraseña != $passwordRepeat) {
            $errores['contraseñaRep'] = "Las contraseñas deben ser iguales";
        }
        return $errores;
    }   

    public static function validarLogin($datos)
    {
        $errores = [];
        $email = trim($datos['email']);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Email  inválido...";
        }
        $password = trim($datos['contraseña']);
        if(empty($password)){
            $errores['contraseña'] = "Password  no lo puede dejar en blanco...";
        }elseif (strlen($password)<6) {
            $errores['contraseña'] = "Password  sólo debe tener un minimo de 6 digitos";
        }
        return $errores;
    }
    public static function validarProducto($producto)
    {
        $db = Conexion :: conectar();
        $nombreProducto = trim($producto->getProductName());
        $errores = [];
        if (strlen($nombreProducto) == 0) {
            $errores['nombre'] = "El nombre no puede estar vacio";
        } else if(empty($_FILES['portada']['tmp_name'])){
            $errores['portada'] = "Debe agregar una imagen del producto";
        }
        return $errores;
    }
    public static function validarCategoria($categoria)
    {
        $nombreCategoria = trim($categoria->getCategoriaNombre());
        $precioCategoria = $categoria->getPrecio();
        var_dump($precioCategoria);
        $errores = [];
        if (strlen($nombreCategoria) == 0) 
        {
            $errores['nombre'] = "Ingrese nombre de categoria";
        }
        if ($precioCategoria <= 0 ) 
        {
            $errores['precio'] = "Ingrese precio";
        }
        return $errores;
    }
    public static function validarModificarProducto($datos, $portada)
    {
        $db = Conexion ::conectar();
        $errores = [];
        $nombre = trim($datos['nombre']);
        $categoriaId = $datos['categoria'];
        if(empty($nombre)){
            $errores['nombre'] = "Debe introducir un nombre";
        } if(empty($portada['portada']['tmp_name'])){
            $errores['portada'] = "Debe agregar una imagen del producto";
        }
        return $errores;
    }
}
