<?php
require_once 'includes/config.php';
require_once 'includes/src/Restaurante.php';

// Obtener el id del restaurante de la URL
$id_rest = $_GET['id_rest'];

// Consultar la información del restaurante
 // $sql = "SELECT * FROM Restaurantes WHERE id_rest = $id_rest";

 $sql = "SELECT r.*, c.nombre AS categoria FROM Restaurantes r
        INNER JOIN Rest_Cat rc ON r.id_rest = rc.id_rest
        INNER JOIN Categorias c ON rc.id_categoria = c.id_categoria
        WHERE r.id_rest = $id_rest";

$result = $conn->query($sql);


$sql_comentarios = "SELECT nombre_usuario, fecha, puntuacion as puntuacion, comentario FROM Comentarios WHERE id_rest = $id_rest GROUP BY nombre_usuario, fecha, comentario ORDER BY fecha DESC";
$result_comentarios = $conn->query($sql_comentarios);


// Verificar si se encontró un resultado
if ($result->num_rows > 0) {

    $restaurante = $result->fetch_assoc();
    $tituloPagina = $restaurante['nombre'];
    $contenidoPrincipal = "<h2>" . $restaurante['nombre'] . "</h2>" .
      "<img src='" . $restaurante['imagen'] . "' alt='Imagen del restaurante' id='restaurante-imagen'>" .
      "<div id='detalles'>" . "<p><strong>Tipo de cocina:</strong> " . $restaurante['categoria'] . "</p>" .
      "<p><strong>Dirección:</strong> " . $restaurante['direccion'] . "</p>" .
      "<p><strong>Año de apertura:</strong> " . $restaurante['apertura'] . "</p>" .
      "<p><strong>Precio medio por persona:</strong> " . $restaurante['precio'] . " €" . "</p>" ;
    $contenidoPrincipal .= "</div>";

    
        // Verifica si se encontraron comentarios
        if ($result_comentarios->num_rows > 0) {
          $contenidoPrincipal .= "<div id='comentarios'>" .
          "<h3 class='comentarios-titulo'>Reseñas:</h3>";
        
          while ($comentario = $result_comentarios->fetch_assoc()) {
          $contenidoPrincipal .= "<p><strong>" . $comentario['nombre_usuario'] . "</strong> - " . $comentario['fecha'] . " - " . $comentario['puntuacion'] . " estrellas</p>" .
                                "<p>" . $comentario['comentario'] . "</p>";
          }
        } else {
          $contenidoPrincipal .= "<div id='comentarios'>" .
          "<h3 class='comentarios-titulo'>Reseñas:</h3>";
          $contenidoPrincipal .= "<p>Aún no hay comentarios para este restaurante.</p>";
        }
}
 else {
  // Si no se encontró el restaurante, mostrar mensaje de error
  $tituloPagina = 'Restaurante no encontrado';
  $contenidoPrincipal = "<p>Lo sentimos, el restaurante no se encuentra en nuestra base de datos.</p>";
}


require('./includes/src/vistas/plantillas/plantilla.php');

?>