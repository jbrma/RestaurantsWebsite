<?php
require_once 'includes/config.php';
require_once 'includes/src/Restaurante.php';


$idRest = $_GET['id_rest'];

$restaurante = Restaurante::getRestaurantePorId($idRest);

$tituloPagina = 'Editar restaurante';
$contenidoPrincipal = "
<h1>Editar restaurante</h1>
    <form action='' method='POST' id='form-edita'>
        <label for='nombre'>Nombre:</label>
        <input type='text2' name='nombre' value='{$restaurante->getNombre()}' required>

        <label for='apertura'>Año de apertura:</label>
        <input type='number2' name='apertura' value='{$restaurante->getApertura()}' required>

        <label for='direccion'>Dirección:</label>
        <input type='text2' name='direccion' value='{$restaurante->getDireccion()}' required>

        <label for='precio'>Precio medio por persona:</label>
        <input type='number2' name='precio' value='{$restaurante->getPrecio()}' required>

        <label for='imagen'>Ruta de la imagen:</label>
        <input type='text2' name='imagen' value='{$restaurante->getImagen()}' required>
        

        <input type='submit' name='submit' value='Guardar'>
        </div>
    </form>

";


if (isset($_POST['submit'])) {
    // Recoge los nuevos datos
    $nombre = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
    $apertura = htmlspecialchars(trim(strip_tags($_POST['apertura'])));
    $direccion = htmlspecialchars(trim(strip_tags($_POST['direccion'])));
    $precio = htmlspecialchars(trim(strip_tags($_POST['precio'])));
    $imagen = htmlspecialchars(trim(strip_tags($_POST['imagen'])));

    // Actualiza los datos 
    $restaurante->setNombre($nombre);
    $restaurante->setApertura($apertura);
    $restaurante->setDireccion($direccion);
    $restaurante->setPrecio($precio);
    $restaurante->setImagen($imagen);
    $restaurante->edita($idRest, $nombre, $apertura, $precio, $direccion, $imagen);

    // Redirige al restaurante editado
    header("Location: restaurante.php?id_rest=$idRest");
    exit();
}


require_once 'includes/src/vistas/plantillas/plantilla.php';
?>
