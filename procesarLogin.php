<?php
require_once 'includes/config.php';
require_once 'includes/src/usuarios/Usuario.php';
require_once 'includes/vistas/helpers/autoriza.php';

$tituloPagina = 'Iniciar Sesión';

// Capturo las variables username y password
$username = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));


$usuario = Usuario::login($username, $password);

if (!$usuario) {
    $_SESSION['login'] = false;
} else {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $usuario->getNombreUsuario();
    $_SESSION['nombre'] = $usuario->getNombre();
}

if ($_SESSION["login"] == true) {
    $mensaje = "Bienvenido/a ${_SESSION["nombre"]}";
    echo "<meta http-equiv='refresh' content='0; url=index.php?mensaje=" . $mensaje . "'>";
} else {
    $mensaje = "El usuario o la contraseña no son válidos ";
    echo "<meta http-equiv='refresh' content='0; url=login.php?mensaje=" . $mensaje . "'>";
}
?>