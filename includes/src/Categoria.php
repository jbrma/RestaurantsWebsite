<?php
require_once 'includes/src/Aplicacion.php';

class Categoria {

    private $id_categoria;
    private	$nombre;
    private $clave;

    private function __construct($nombre, $clave) {
        $uuid = uniqid();
        $this->id_categoria = hexdec(substr($uuid, 0, 8)) & 0x7fffffff;
        $this->$nombre = $nombre;
        $this->$clave = $clave;
    }

    public function getIdCategoria() {
        return $this->id_categoria;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setIdCategoria($id_cat) {
        $this->id_categoria = $id_cat;
    }

    // IMP: en la la query en las variables que tenian %i he puesto %d porque si no no me da error pero no se añade la casa

    private static function inserta($categoria) {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("INSERT INTO Categorias (id_categoria, nombre, clave) VALUES (%d, '%s', '%s')"
            , $conn->real_escape_string($categoria->id_categoria)
            , $conn->real_escape_string($categoria->nombre)
            , $conn->real_escape_string($categoria->clave)
        );
        if ($conn->query($query)) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public function guarda(){
        return self::inserta($this);
    }

    public static function crea($nombre, $clave) {
        $categoria = new Categoria($nombre, $clave);
        $categoria->guarda();
        return $categoria;
    }


    public static function edita($id_categoria, $nombre, $clave){
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE Categorias SET nombre='%s', clave='%s' WHERE id_categoria=%d"
            , $conn->real_escape_string($nombre)
            , $conn->real_escape_string($clave)
            , $conn->real_escape_string($id_categoria)
        );
        if ( $conn->query($query) ) {
            $result = true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function elimina($id_categoria){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "DELETE FROM Categorias WHERE id_categoria = $id_categoria";
        if ($conn->query($sql)) {
            return true;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
    }

    public static function getPorId($id_categoria){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM Categorias WHERE id_categoria = $id_categoria";
        $resultado = $conn->query($query);
        if ($resultado->num_rows == 1) {
            $fila = $resultado->fetch_assoc();
            $categoria = new Categoria($fila['nombre'], $fila['clave']);
            $categoria->id_categoria = $fila['id_categoria'];
            return $categoria;
        } else {
            return null;
        }
    }

    public static function getTodas() {
        $categorias = array();
        $conn = Aplicacion::getInstance()->getConexionBd();
        $sql = "SELECT * FROM Categorias";
        $rs = $conn->query($sql);
        if ($rs) {
            while ($fila = $rs->fetch_assoc()) {
                $categoria = new Categoria(
                    $fila["id_categoria"],
                    $fila["nombre"],
                    $fila["clave"]
                );
                array_push($categorias, $categoria);
            }
            $rs->free();
        } else {
            error_log("Error al obtener las categorías de la BD: " . $conn->error);
        }
        return $categorias;
    }
} 
?>