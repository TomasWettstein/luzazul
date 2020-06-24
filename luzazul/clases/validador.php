<?php
class Validador{
    public function validarRegistro($usuario, $contraseñaRep){
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
}
?>