<?php
require_once 'includes/src/Aplicacion.php';

class Restaurante {

    private $id_rest;
    private $nombre;
    private $apertura;
    private $direccion;
    private $imagen;
    private $id_editor;

    private function __construct($nombre, $apertura, $direccion, $imagen, $id_editor) {
        $uuid = uniqid();
        $this->id_rest = hexdec(substr($uuid, 0, 8)) & 0x7fffffff;
        $this->nombre = $nombre;
        $this->apertura = $apertura;
        $this->direccion = $direccion;
        $this->imagen = $imagen;
        $this->id_editor = $id_editor;
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

    public function getIdEditor() {
        return $this->id_editor;
    }

    private static function inserta($restaurante){
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("INSERT INTO Restaurantes (id_rest, nombre, apertura, direccion, imagen, id_editor) VALUES (%d, '%s', %d, '%s', '%s', %d)"
            , $conn->real_escape_string($restaurante->id_rest)
            , $conn->real_escape_string($restaurante->nombre)
            , $conn->real_escape_string($restaurante->apertura)
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

    public static function crea($nombre, $apertura, $direccion, $imagen, $id_editor){
        $restaurante = new Restaurante($nombre, $apertura, $direccion, $imagen, $id_editor);
        $restaurante->guarda();
        return $restaurante;
    }

    public static function edita($id_rest, $campos){
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Restaurantes SET $campos WHERE id_rest = %d", $conn->real_escape_string($id_rest));
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
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ($rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $restaurante = self::creaObjetoRestaurante($fila);
                $result = $restaurante;
            }
            $rs->free();
        } else {
            error_log("Error al consultar en la BD: " . $conn->error);
        }
        return $result;
    }

    public static function getTodos() {
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBd();
        $query = "SELECT * FROM Restaurantes";
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $result = array();
            while ($fila = $rs->fetch_assoc()) {
                $restaurante = self::creaObjetoRestaurante($fila);
                array_push($result, $restaurante);
            }
            $rs->free();
        } else {
            error_log("Error al consultar en la BD: " . $conn->error);
        }
        return $result;
    }

    public static function getPorCategoria($id_categoria) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM Restaurantes r
                          JOIN Rest_Cat rc ON r.id_rest = rc.id_rest
                          WHERE rc.id_categoria = %d", $conn->real_escape_string($id_categoria));
        $result = $conn->query($query);
        $restaurantes = array();
        while ($row = $result->fetch_assoc()) {
            $restaurante = new Restaurante($row['nombre'], $row['apertura'], $row['direccion'], $row['imagen'], $row['id_editor']);
            $restaurante->setId($row['id_rest']);
            $restaurantes[] = $restaurante;
        }
        return $restaurantes;
    }

}