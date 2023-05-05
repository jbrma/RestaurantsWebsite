<?php
require_once 'includes/src/Aplicacion.php';

class Restaurante {

    private $id_rest;
    private $nombre;
    private $apertura;
    private $direccion;
    private $imagen;

    private function __construct($nombre, $apertura, $precio, $direccion, $imagen) {
        $uuid = uniqid();
        $this->id_rest = hexdec(substr($uuid, 0, 8)) & 0x7fffffff;
        $this->nombre = $nombre;
        $this->apertura = $apertura;
        $this->precio = $precio;
        $this->direccion = $direccion;
        $this->imagen = $imagen;
    }

    
    public function getIdRest() {
        return $this->id_rest;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApertura() {
        return $this->apertura;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setId($id) {
        $this->id_rest = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApertura($apertura) {
        $this->apertura = $apertura;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    


    private static function inserta($restaurante){
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Restaurantes (id_rest, nombre, apertura, precio, direccion, imagen, id_editor) VALUES (%d, '%s', %d, '%s', '%s', %d)"
            , $conn->real_escape_string($restaurante->id_rest)
            , $conn->real_escape_string($restaurante->nombre)
            , $conn->real_escape_string($restaurante->apertura)
            , $conn->real_escape_string($restaurante->precio)
            , $conn->real_escape_string($restaurante->direccion)
            , $conn->real_escape_string($restaurante->imagen)
            , $conn->real_escape_string($restaurante->id_editor)
        );
        if ( $conn->query($query) ) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public function guarda(){
        return self::inserta($this);
    }


    public static function crea($nombre, $apertura, $precio, $direccion, $imagen){
        $restaurante = new Restaurante($nombre, $apertura, $precio, $direccion, $imagen);
        $restaurante->guarda();
        return $restaurante;
    }

    public static function edita($id_rest, $nombre, $apertura, $precio, $direccion, $imagen){
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("UPDATE Restaurantes SET nombre='%s', apertura='%s', direccion='%s', precio=%f, imagen='%s' WHERE id_rest = %d",
            $conn->real_escape_string($nombre),
            $conn->real_escape_string($apertura),
            $conn->real_escape_string($direccion),
            $precio,
            $conn->real_escape_string($imagen),
            $conn->real_escape_string($id_rest));
        if ( $conn->query($query) ) {
            $result = true;
        } else {
            $mensaje = "Error al actualizar los datos: " . $conn->error;
        }
        return $result;
    }
    

    public static function elimina($id_rest){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "DELETE FROM Restaurantes WHERE id_rest = " . $conn->real_escape_string($id_rest);
        if ($conn->query($sql)) {
            return true;
        } else {
            $mensaje = "Error al eliminar el restaurante: " . $conn->error;
            return false;
        }
    }

    public static function getRestaurantePorId($id_rest) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Restaurantes WHERE id_rest = '%s'", $conn->real_escape_string($id_rest));
        $result = $conn->query($query);
        $restaurante = false;
  
        if ($result) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $restaurante = new Restaurante($row['nombre'], $row['apertura'], $row['precio'],$row['direccion'], $row['imagen']);
            }
            $result->free();
        } else {
            error_log("Error al consultar en la BD: " . $conn->error);
        }

        return $restaurante;
    }

    public static function getTodos() {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Restaurantes") ;
        $result = $conn->query($query);
        $restaurantes = array();
        while ($row = $result->fetch_assoc()) {
            $restaurante = new Restaurante($row['nombre'], $row['apertura'], $row['precio'],$row['direccion'], $row['imagen']);
            $restaurante->setId($row['id_rest']);
            $restaurantes[] = $restaurante;
        }
        return $restaurantes;
    }

    public static function getPorCategoria($id_categoria) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Restaurantes r
                          JOIN Rest_Cat rc ON r.id_rest = rc.id_rest
                          WHERE rc.id_categoria = %d", $conn->real_escape_string($id_categoria));
        $result = $conn->query($query);
        $restaurantes = array();
        while ($row = $result->fetch_assoc()) {
            $restaurante = new Restaurante($row['nombre'], $row['apertura'], $row['precio'],$row['direccion'], $row['imagen']);
            $restaurante->setId($row['id_rest']);
            $restaurantes[] = $restaurante;
        }
        return $restaurantes;
    }

}