<?php

require_once 'src/Aplicacion.php';

/**
 * Parámetros de conexión a la BD
 */
define('BD_HOST', 'localhost');
define('BD_NAME', 'proyecto');
define('BD_USER', 'user');
define('BD_PASS', 'userpass');

/**
 * Parámetros de configuración utilizados para generar las URLs y las rutas a ficheros en la aplicación
 */
define('RAIZ_APP', __DIR__);
define('RUTA_APP', '/SW-I');
define('RUTA_IMGS', RUTA_APP.'img/');
define('RUTA_CSS', RUTA_APP.'css/');
define('RUTA_JS', RUTA_APP.'js/');


//Conexion con la base de datos
$conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
if ($conn->connect_error) {
    die("La conexión ha fallado" . $conn->connect_error);
}

/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');


/* */
/* Inicialización de la aplicación */
/* */

$app = Aplicacion::getInstance();
$app->init(['host' => BD_HOST, 'bd' => BD_NAME, 'user' => BD_USER, 'pass' => BD_PASS]);
