<?php

require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Portada';

$contenidoPrincipal=<<<EOS
  <h1>Inicio</h1>
EOS;

$contenidoPrincipal .= "
    <div class='texto-ejemplos-restaurantes'>
    
        <h2>RESTAURANTES DESTACADOS</h2>
        
        <div class='ejemplos-restaurantes'>

        <div class='rest1'>
            <a href='restaurante.php?id_rest=1'>
            <img src='img/mexicano.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante Mexicano</h3>
            </a>
            <p>Categoría: Mexicano</p>
        </div>

        <div class='rest2'>
            <a href='restaurante.php?id_rest=2'>
            <img src='img/chino.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante Chino</h3>
            </a>
            <p>Categoría: Chino</p>
        </div>
        
        <div class='rest3'>
            <a href='restaurante.php?id_rest=3'>
            <img src='img/italiano.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante Italiano</h3>
            </a>
            <p>Categoría: Italiano</p>
        </div>

        <div class='rest4'>
            <a href='restaurante.php?id_rest=10'>
            <img src='img/español.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante Español</h3>
            </a>
            <p>Categoría: Español</p>
        </div>

        <div class='rest5'>
            <a href='restaurante.php?id_rest=11'>
            <img src='img/español2.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante VIP</h3>
            </a>
            <p>Categoría: Español</p>
        </div>
        
        <div class='rest6'>
            <a href='restaurante.php?id_rest=6'>
            <img src='img/italiano2.jpg' alt='Imagen del restaurante'>
            <h3>Restaurante Nonna</h3>
            </a>
            <p>Categoría: Italiano</p>
        </div>
        
       </div>
       
       <div class= 'que-es'>
       <h2>¿QUÉ ES GASTROSCORE?</h2>
       <p>Nuestra web se encarga de la gestión de valoraciones de restaurantes para que puedas elegir el lugar perfecto para tu próxima comida o cena. 
       Aquí encontrarás las opiniones y valoraciones de otros clientes, así como información detallada de cada restaurante, para que puedas tomar una buena decisión.

       La plataforma es fácil de usar, permitiendo a los usuarios encontrar rápidamente los restaurantes que se ajustan a sus preferencias de comida o ubicación. 

        </p>
       </div>
       </a>
    ";

$params = ['tituloPagina' => $tituloPagina, 'contenidoPrincipal' => $contenidoPrincipal];

$contenidoPrincipal .= <<<EOS
EOS;

require('./includes/src/vistas/plantillas/plantilla.php');

?>