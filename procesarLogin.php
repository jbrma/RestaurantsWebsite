<?php
require_once 'includes/config.php';
require_once 'includes/src/usuarios/Usuario.php';

$tituloPagina = 'Inicia Sesión';

$correo = htmlspecialchars(trim(strip_tags($_REQUEST["correo"])));
$password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));


$usuario = Usuario::login($correo, $password);

if (!$usuario) {
    $_SESSION['login'] = false;

} else {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $usuario->getNombreUsuario();
    $_SESSION['nombre'] = $usuario->getNombre();
    $_SESSION['rol'] = $usuario->getRol();
}

if ($_SESSION['login'] == true) {
    $mensaje = "Bienvenido/a ${_SESSION['nombre']}";
    echo "<meta http-equiv='refresh' content='0; url=index.php?mensaje=" . $mensaje . "'>";
} else {
    $mensaje = "El usuario o la contraseña no son válidos";
    echo "<meta http-equiv='refresh' content='0; url=login.php?mensaje=" . $mensaje . "'>";
}
?>