<?php

class Usuario
{
    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    public const EDITOR_ROLE = 3;

  
    private $nombreUsuario;
    private $password;
    private $nombre;
    private $correo;
    private $rol;

    private function __construct($nombreUsuario, $password, $nombre, $correo, $rol)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->rol = $rol; //todas las personas que se registren a partir de ahora van a ser usuarios
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function compruebaPassword($password, $correo)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.correo='%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if($fila){
                return password_verify($password, $fila['password']); 
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }

        return false;
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }

    public static function login($correo, $password)
    {
        $usuario = self::buscaUsuario($correo);
        if ($usuario && $usuario->compruebaPassword($password, $correo)) {
            return $usuario;
        }
        return false;
    }
    
    public static function crea($nombreUsuario, $password, $nombre, $correo, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre, $correo, 2);
        $user->guarda();
        return $user;
    }

    public static function buscaUsuario($correo)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuarios U WHERE U.correo='%s'", $conn->real_escape_string($correo));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Usuario($fila['username'], $fila['password'], $fila['nombre'], $fila['correo'], $fila['rol']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function inserta($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Usuarios(username, nombre, password, correo, rol) VALUES ('%s', '%s', '%s', '%s', '%s')"
            , $conn->real_escape_string($usuario->nombreUsuario)
            , $conn->real_escape_string($usuario->nombre)
            , $conn->real_escape_string($usuario->password)
            , $conn->real_escape_string($usuario->correo)
            , $conn->real_escape_string($usuario->rol)
        );
        if ( $conn->query($query) ) {
             
            //$result = self::insertaRoles($usuario);
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }
   
    public function guarda()
    {
       /*  if ($this->id !== null) {
            return self::actualiza($this);
        } */
        return self::inserta($this);
    }
    
    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }
    
}
