<?php

require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Registro';
$contenidoPrincipal=<<<EOS
<form action="procesarRegistro.php" method="POST" id="registro">
<fieldset>
    <h3> Rellena los siguientes datos </h3>
    <br/><input type="text" name="email" placeholder="Correo electrónico" required/>
    <br/><input type="text" name="username" placeholder="Nombre de usuario" required/>
    <br/><input type="text" name="name" placeholder="Nombre" required/>
    <br/><input type="password" name="password" placeholder="Contraseña" required/>
    <br/><input type="password" name="password2" placeholder="Repita la contraseña" required/>
    <br/><button type="submit">REGISTRARSE</button>
</fieldset>
<h4>¿Ya tienes cuenta? </h4>
<a href="login.php"><button type="button" id="login2-button">INICIAR SESIÓN</button></a>

EOS;

require ('./includes/src/vistas/plantillas/plantilla.php');
?>