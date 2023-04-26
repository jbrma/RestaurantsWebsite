<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<title><?= $tituloPagina ?></title>
</head>
<body>
<div id="contenedor">
<?php
if(!isset($mensaje))
	$mensaje = "";
if(isset($_GET['mensaje'])){
    $mensaje = $_GET['mensaje'];}

require ('includes/src/vistas/comun/cabecera.php');
?>
	<main>
		<article> 
			<h1> <?= $mensaje ?> </h1>
			<?= $contenidoPrincipal?>
		</article>
	</main>
</div>
<?php
require('includes/src/vistas/comun/pie.php');
?>
</body>
</html>
