<?php
require_once 'includes/config.php';
require_once 'includes/src/Restaurante.php';

$restaurantes = Restaurante::getTodos();

$contenidoPrincipal = "";

if ($restaurantes) {
    foreach ($restaurantes as $restaurante) {
        $contenidoPrincipal .= 
        "<div class='restaurante-container'>".
            "<a href='restaurante.php?id_rest=" . $restaurante->getIdRest() . "'>" .
            "<img src='" . $restaurante->getImagen() . "' alt='Imagen del restaurante' id='restaurante-imagen-categoria'>".
            "<div class='restaurante-info'>".
            "<h2>" . $restaurante->getNombre() . "</h2></a>".
        "<p><strong>Año de apertura:</strong> " . $restaurante->getApertura() . "</p>".
        "<p><strong>Dirección:</strong> " . $restaurante->getDireccion() . "</p>".
        "<p><strong>Precio medio por persona:</strong> " . $restaurante->getPrecio() . " €" . "</p>".
        "<div class='boton-editar'>".
        "<a href='editarRestaurante.php?id_rest=" . $restaurante->getIdRest() . "'>Editar</a>" .
        "</div>".
        "</div>".
        "</div>";
    }
} else {
    $contenidoPrincipal .=  "No se encontraron restaurantes para la categoría seleccionada";
}

require_once 'includes/src/vistas/plantillas/plantilla.php';


