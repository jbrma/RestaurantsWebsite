<?php
require_once 'includes/config.php';

// Obtener el id del restaurante de la URL
$id_rest = $_GET['id_rest'];

// Consultar la información del restaurante
$sql = "SELECT * FROM Restaurantes WHERE id_rest = $id_rest";
$result = $conn->query($sql);

// Verificar si se encontró un resultado
if ($result->num_rows > 0) {
  $restaurante = $result->fetch_assoc();
  $tituloPagina = $restaurante['nombre'];
  $contenidoPrincipal = "<h2>" . $restaurante['nombre'] . "</h2>" .
    "<img src='" . $restaurante['imagen'] . "' alt='Imagen del restaurante' id='restaurante-imagen'>" .
    "<p><strong>Dirección:</strong> " . $restaurante['direccion'] . "</p>" .
    "<p><strong>Año de apertura:</strong> " . $restaurante['apertura'] . "</p>";
/*
  // Si el usuario ha iniciado sesión, mostrar botón para reservar
  if (isset($_SESSION['id_usuario'])) {
    $contenidoPrincipal .= "<a href='reservar.php?id_rest=" . $id_rest . "'><button type='button'>Reservar</button></a>";
  }
*/

} else {
  // Si no se encontró el restaurante, mostrar mensaje de error
  $tituloPagina = 'Restaurante no encontrado';
  $contenidoPrincipal = "<p>Lo sentimos, el restaurante que buscas no se encuentra en nuestra base de datos.</p>";
}


require('./includes/src/vistas/plantillas/plantilla.php');

?>