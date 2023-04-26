<?php

$tituloPagina = 'Iniciar Sesión';

$contenidoPrincipal=<<<EOS

    <form action="procesarLogin.php" method="POST" id="login">
    <fieldset>
        <h3> Inicia Sesión o Regístrate </h3>
        <br/><input type="text" name="email" placeholder="Correo electrónico" required/>
        <br/><input type="password" name="password" placeholder="Contraseña" required/>
        <br/><br/><button type="submit" id="login-button">INICIAR SESIÓN</button>
    </fieldset>
    <h5>↓ ¿No tienes cuenta? ↓</h5>
    <a href="registro.php"><button type="button" id="register-button">REGISTRARSE</button></a>

EOS;

require ('./includes/vistas/plantillas/plantilla.php');
?>

