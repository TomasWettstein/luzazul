<?php
class Conexion{
    public static function conectar()
    {
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
    public static function consultar(string $select, string $from, $where = null)
    {
        $db = Conexion :: conectar();
        if(!isset($where))
        {
            $sql = "SELECT $select FROM $from";
            $query = $db-> prepare($sql);
            $query-> execute();
            return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
        }else
        {
            $sql = "SELECT $select FROM $from WHERE id =  $where";
            $query = $db-> prepare($sql);
            $query-> execute();
            return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);
        }
    }
    public static function consultarLogin(string $select, string $from, $where)
    {
        $db = Conexion :: conectar();
        $sql = "SELECT $select FROM $from WHERE email =  '$where'";
        $query = $db-> prepare($sql);
        $query-> execute();
        return $consulta = $query-> fetchAll(PDO :: FETCH_ASSOC);  
    }
    public static function consultarProductosPorCategoria(string $select, $from, $where)
    {
        $db = Conexion::conectar();
        $sql = "SELECT $select FROM $from WHERE categoria_id = $where";
        $query = $db->prepare($sql);
        $query->execute();
        return $consulta = $query-> fetchAll(PDO::FETCH_ASSOC);
    }
    public static function registrarUsuario($usuario)
    {
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

        if ($ingresar->execute())
        {
            $message = 'Successfully created new user';
        } else
        {
            $message = 'Sorry there must have been an issue creating your account';
        }
    }
   public static function seteoUsuario($usuario,$datos)
   {
        $_SESSION["nombre"] = "$usuario[nombre]"; 
        $_SESSION["email"] = "$usuario[email]"; 
        $_SESSION["is_admin"] = "$usuario[is_admin]"; 
        if($datos['recordarme'] === 'recordarme' ) 
        {
            setcookie('email', $datos['email'] , time()+3600);
            setcookie('password' ,$datos['password'],time()+3600);
        }
    }
    //Funcion que valida el acceso
    public static function validarUsuario()
    {
        if(isset($_SESSION['email']))
        {
            return true;
        }elseif (isset($_COOKIE['email'])) 
        {
            $_SESSION['email'] = $_COOKIE['email'];
            return true;
        }else
        {
            return false;
        }
    }
    public static function armarFoto($imagen)
    {
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
    public static function agregarProducto($producto, $imagen)
    {
        $nombre = $producto->getProductName();
        $foto = $imagen;
        $categoria_id = $producto->getCategoria();
        $db = Conexion :: conectar();
        $sql = "INSERT INTO productos (nombre, foto, categoria_id) values (:nombre, :foto , :categoria_id)";
        $query = $db-> prepare($sql);
        $query-> bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $query-> bindValue(':foto', $foto, PDO::PARAM_STR);
        $query-> bindValue(':categoria_id', $categoria_id, PDO::PARAM_STR);
        $query->execute();
    }
    public static function modificarProducto($datos, $id)
    {
        $nombre = $datos['nombre'];
        $precio = $datos['precio'];
        $categoria = $datos['categoria'];
        $db = Conexion::conectar();
        $sql = "UPDATE `luzazul`.`productos` SET `nombre` = '$nombre', `precio` = '$precio', `categoria_id` = '$categoria' WHERE (`id` = '$id');";
        $modificar = $db->prepare($sql);
        $modificar->execute();
    }
    public static function eliminarProducto($id)
    {
        $db = Conexion::conectar();
        $sql = "DELETE FROM `luzazul`.`productos` WHERE (`id` = '$id');";
        $eliminar = $db->prepare($sql);
        $eliminar->execute();
    }
    public static function eliminarCategoria($id)
    {
        $db = Conexion::conectar();
        $sql = "DELETE FROM `luzazul`.`categorias` WHERE (`id` = '$id');";
        $eliminar = $db->prepare($sql);
        $eliminar->execute();
    }
    public static function buscarPorEmail($bd,$tabla,$email)
    {
        $sql="select * from $tabla where email='$email'";
        $query=$bd->prepare($sql);
        $query->execute();
        $usuario=$query->fetch(PDO::FETCH_ASSOC);
        if($usuario !=null)
        {
            if($email === $usuario['email'])
            {
                return $usuario;
            }  
        }
        return null;
    }   
}
?>