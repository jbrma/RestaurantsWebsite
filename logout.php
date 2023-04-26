<?php
require_once __DIR__.'/includes/config.php';
require_once 'includes/vistas/helpers/sesion.php';

logout();

$tituloPagina = 'Logout';

$contenidoPrincipal=<<<EOS
	<h1>¡Hasta la próxima!</h1>
EOS;

require 'includes/vistas/comun/plantillas/plantilla.php';
