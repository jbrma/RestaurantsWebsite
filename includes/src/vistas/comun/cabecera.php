<?php
require_once 'includes/config.php';
require_once 'includes/src/usuarios/Usuario.php';

$status = 0;
$status_ed = 0;


if (isset($_SESSION["login"]) && ($_SESSION["login"] == true)) {// Logged In
    $status = 1;

}
else{
    $status = 0;
    $status_ed = 0;
}

if (isset($_SESSION["rol"])) {
    // La clave "rol" está definida en la sesión
    $rol = $_SESSION["rol"];
} else {
    // La clave "rol" no está definida en la sesión
    $rol = null; // o cualquier otro valor que desees asignar en caso de que no esté definida
}


if (($status == 1) && ($rol == 3)){

    $status_ed = 1;
}
else{

    $status_ed = 0;
}
?>

<header id="cabecera">
    <a href="./index.php">
        <img src="./includes/util/logo.png"  alt="Logo" height="150px" id="logo-cabecera">
    </a>

    <nav id="categorias">
        <ul>
            <li><img src="./img/banderas/mexico.png" id="banderas"><a href="./categoria.php?id_categoria=1">Mexicano</a>
            <li><img src="./img/banderas/españa.png" id="banderas"><a href="./categoria.php?id_categoria=4">Español</a>
            <li><img src="./img/banderas/china.png" id="banderas"><a href="./categoria.php?id_categoria=2">Chino</a>
            <li><img src="./img/banderas/italia.png" id="banderas"><a href="./categoria.php?id_categoria=3">Italiano</a>
       
        </ul>
    </nav>
    
    <nav id="boton-login">
       
        <?php
        if ($status == 0) {
            echo ' <a href="./login.php"> Inicia Sesión </a> <br> <br>';

        } 
        else {
            
            echo ' <a href="./cierraSesion.php"> Cierra Sesión </a> <br> <br> ';

            if ($status_ed == 1) {

                echo ' <a href="./todosRestaurantes.php" id="boton-todos-restaurantes"> Restaurantes</a> <br> <br>';
            }
        }

        ?>
    </nav>
     

</header>