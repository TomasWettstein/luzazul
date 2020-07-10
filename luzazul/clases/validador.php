<?php
class Validador{
    public static function validarRegistro($usuario, $contraseñaRep){
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
        if ($contraseña != $contraseñaRep) {
            $errores['contraseñaRep'] = "Las contraseñas deben ser iguales";
        }
        return $errores;
    }   

    public static function validarLogin($usuario, $contraseña){
        $db = Conexion :: conectar();
        $user = $usuario-> getEmail();
        $consulta = Conexion :: consultar("*", "usuarios", "email = '$user'");

        $errores = [];
        $email = trim($usuario->getEmail());
        $password = trim($usuario->getPassword());

        if (strlen($email) == 0) {
            $errores['email'] = "El email no puede estar vacio";
        }
        elseif (empty($consulta)) {
            $errores['email'] = "El usuario no se encuentra registrado";
        }

        if (strlen($usuario-> getPassword()) == 0) {
            $errores['contraseña'] = 'La contraseña no puede estar vacia';
        }

        foreach($consulta as $key => $value){
            if ($value['contraseña'] != password_verify($password, $contraseña)) {
             $errores['contraseña'] = 'La contraseña es incorrecta';
            }
        }
        return $errores;
    }
    public static function validarProducto($producto){

        $db = Conexion :: conectar();
        $nombreProducto = trim($producto->getProductName());
        $precio = $producto->getPrecio();
        $foto = $producto->getFoto();
        $errores = [];
        if (strlen($nombreProducto) == 0) {
            $errores['nombre'] = "El nombre no puede estar vacio";
        } else if($precio == null) {
            $errores['precio'] = "Debe agregar un precio";
        } else if($foto == null){
            $errores['foto'] = "Debe agregar una imagen del producto";
        }
        return $errores;

    }
    public static function validarModificarProducto($datos){
        $db = Conexion ::conectar();
        $errores = [];
        $nombre = trim($datos['nombre']);
        $precio = $datos['precio'];
        $categoriaId = $datos['categoria'];
        if(empty($nombre)){
            $errores['nombre'] = "Debe introducir un nombre";
        } if(empty($precio)){
            $errores['precio'] = "Debe introducir un precio";
        }
        return $errores;
    }
}
?>