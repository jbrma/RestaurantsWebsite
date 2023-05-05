<?php
require_once 'includes/config.php';
require_once 'includes/src/Usuarios/Usuario.php'; 

// Capturo las variables 
 $correo = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));
 $password = htmlspecialchars(trim(strip_tags($_REQUEST["password"])));
 $password2 = htmlspecialchars(trim(strip_tags($_REQUEST["password2"])));
 $username = htmlspecialchars(trim(strip_tags($_REQUEST["username"])));
 $nombre = htmlspecialchars(trim(strip_tags($_REQUEST["name"])));

$empty = 0;
$mensaje = "";

if($password != $password2){
    $mensaje .= "Las contraseñas deben coincidir";
    echo "<meta http-equiv='refresh' content='0; url=registro.php?mensaje=".$mensaje."'>";
}
else{
    $usuario = Usuario::buscaUsuario($correo);
    
    if ($usuario) {
        $mensaje = "Ese usuario ya existe! Prueba con otro correo electrónico";
        echo "<meta http-equiv='refresh' content='0; url=registro.php?mensaje=".$mensaje."'>";
    } else {
        $usuario = Usuario::crea($username, $password, $nombre, $correo, 2);
        $_SESSION['login'] = true;
        $_SESSION['correo'] = $usuario->getCorreo();

    }
}

// Proceso las variables comprobando si es un usuario valido

$tituloPagina = 'Registro';

if (isset($_SESSION["login"])){
    $mensaje =  "Bienvenido/a ${_SESSION["nombre"]}";
    echo "<meta http-equiv='refresh' content='0; url=index.php?mensaje=".$mensaje."'>";
}
?>

