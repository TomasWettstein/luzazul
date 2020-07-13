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
            $sql = "SELECT $select FROM $from WHERE id =  $where";
            $query = $db-> prepare($sql);
            $query-> execute();
            return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
        }
    }
    public static function consultarProductosPorCategoria(string $select, $from, $where){
        $db = Conexion::conectar();
        $sql = "SELECT $select FROM $from WHERE categoria_id = $where";
        $query = $db->prepare($sql);
        $query->execute();
        return $consulta = $query-> fetchAll(PDO::FETCH_ASSOC);
    }
    public static function registrarUsuario($usuario){
    
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
        $user = $_POST['email'];
        $consulta = Conexion :: consultar("*", "usuarios", "email = '$user'");
        foreach($consulta as $key => $value){
            $_SESSION['id'] = $value['id'];
            $_SESSION['nombre'] = $value['nombre'];
            $_SESSION['email'] = $value['email'];
            $_SESSION['contraseña'] = $value['contraseña'];
            $_SESSION['is_admin'] = $value['is_admin'];
        }
        return $_SESSION;
    }
    public static function armarFoto($imagen){
        $nombre = $imagen["foto"]["name"];
        $ext = pathinfo($nombre,PATHINFO_EXTENSION);
        $archivoOrigen = $imagen["foto"]["tmp_name"];
        $archivoDestino = dirname(__DIR__);
        $archivoDestino = $archivoDestino."/images/";
        $imagen = uniqid();
        $archivoDestino = $archivoDestino.$imagen;

        $archivoDestino = $archivoDestino.".".$ext;
        
        move_uploaded_file($archivoOrigen,$archivoDestino);
        $imagen = $imagen.".".$ext;
        
        return $imagen;
    }
    public static function agregarProducto($producto, $imagen){
        $nombre = $producto->getProductName();
        $precio = $producto->getPrecio();
        $foto = $imagen;
        $categoria_id = $producto->getCategoria();
        $db = Conexion :: conectar();
        $sql = "INSERT INTO productos (nombre, precio, foto, categoria_id) values (:nombre, :precio, :foto , :categoria_id)";
        $query = $db-> prepare($sql);
        $query-> bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $query-> bindValue(':precio', $precio, PDO::PARAM_STR);
        $query-> bindValue(':foto', $foto, PDO::PARAM_STR);
        $query-> bindValue(':categoria_id', $categoria_id, PDO::PARAM_STR);
        $query->execute();
    }
    public static function modificarProducto($datos, $id){
        $nombre = $datos['nombre'];
        $precio = $datos['precio'];
        $categoria = $datos['categoria'];
        $db = Conexion::conectar();
        $sql = "UPDATE `luzazul`.`productos` SET `nombre` = '$nombre', `precio` = '$precio', `categoria_id` = '$categoria' WHERE (`id` = '$id');";
        $modificar = $db->prepare($sql);
        $modificar->execute();
    }
    public static function eliminarProducto($id){
        $db = Conexion::conectar();
        $sql = "DELETE FROM `luzazul`.`productos` WHERE (`id` = '$id');";
        $eliminar = $db->prepare($sql);
        $eliminar->execute();
    }

}
