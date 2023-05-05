<?php
require_once 'includes/config.php';
require_once 'includes/src/usuarios/Usuario.php';

$_SESSION['login'] = NULL;

$mensaje =  "Has cerrado la sesión";
echo "<meta http-equiv='refresh' content='1; url=index.php?mensaje=".$mensaje."'>";
?>