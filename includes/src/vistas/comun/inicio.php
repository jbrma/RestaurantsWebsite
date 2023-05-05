<?php
require_once 'includes/config.php';
require_once 'includes/src/Usuarios/Usuario.php';

$status = 0;
if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) // Logged In
    $status = 1;
else
    $status = 0;

?>


<div id="menu-div">
    <a href="./index.php">
        Inicio
    </a> <br> <br>
    <?php
    if ($status == 0) {
        echo ' <a href="./login.php">
                    Iniciar Sesión / Registrarse
                    </a> <br> <br>';
    } else {
        echo ' <a href="./cerrarSesion.php">
                    Cerrar Sesión
                    </a> <br> <br> ';
    }

    ?>

</div>