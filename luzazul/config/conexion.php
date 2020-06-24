<?php
class Conexion{
    public static function conectar(){
        $host = "127.0.0.1";
        $port = "3306";
        $dbname = "luzazul";
        $charset = "utf8mb4";
        $user_name = "root";
        $user_pas = "";
        $dsn = "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset";
        $db = new PDO($dsn,$user_name,$user_pas);
     
        return $db;
    }
    public static function consultar(string $select, string $from, $where = null){
        $db = Conexion :: conectar();
        if(!isset($where)){
            $sql = "SELECT $select FROM $from";
            $query = $db-> prepare($sql);
            $query-> execute();
            return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
        }else{
            $sql = "SELECT $select FROM $from WHERE $where";
            $query = $db-> prepare($sql);
            $query-> execute();
            return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
        }
    }
    public function registrarUsuario($usuario){
    
        $nombre = $usuario-> getUserName();
        $email = $usuario-> getEmail();
        $password = $usuario-> getPassword(); 
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $db = Conexion :: conectar();

        $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (:nombre, :email, :hash)";

        $ingresar = $db-> prepare($sql);

        $ingresar-> bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $ingresar-> bindValue(':email', $email, PDO::PARAM_STR);
        $ingresar-> bindValue(':hash', $hash, PDO::PARAM_STR);

        if ($ingresar->execute()) {
            $message = 'Successfully created new user';
          } else {
            $message = 'Sorry there must have been an issue creating your account';
          }

    }
    public static function iniciarSesion($usuario){
        var_dump($usuario);
        $usuario = $_POST['email'];
        $consulta = Conexion :: consultar("*", "usuarios", "email = '$usuario'");
        foreach($consulta as $key => $value){
            $_SESSION['id'] = $value['id'];
            $_SESSION['nombre'] = $value['nombre'];
            $_SESSION['contraseña'] = $value['contraseña'];
            $_SESSION['is_admin'] = $value['is_admin'];
        }
        return $_SESSION;
    }

}


  
?>