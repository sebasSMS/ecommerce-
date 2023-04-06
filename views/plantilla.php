<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta name="title" content="Tienda Virtual">

	<meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam accusantium enim esse eos officiis sit officia">

	<meta name="keyword" content="Lorem ipsum, dolor sit amet, consectetur, adipisicing, elit, Quisquam, accusantium, enim, esse">

	<title>Tienda Virtual</title>

	<?php
	 session_start();
		$servidor = Ruta::ctrRutaServidor();
		$icono = ControladorPlantilla::ctrEstiloPlantilla();
		$url = Ruta::ctrRuta();

		echo '<link rel="icon" href="http://localhost/backend/'.$icono["icono"].'">';

		/*=============================================
		MANTENER LA RUTA FIJA DEL PROYECTO
		=============================================*/
		
		

	?>

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plugins/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

	<!-- ===========================================
	HOJA DE ESTILO PERSONALISADAS
	================================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/plantilla.css">

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/cabezote.css">

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/slide.css">

	<link rel="stylesheet" href="<?php echo $url; ?>views/css/productos.css">
	<!-- ===========================================
	PLUGINS DE CSS
	================================================-->

	<script src="<?php echo $url; ?>views/js/plugins/jquery.min.js"></script>

	<script src="<?php echo $url; ?>views/js/plugins/bootstrap.min.js"></script>

	<script src="<?php echo $url; ?>views/js/plugins/jquery.easing.js"></script>

	<script src="<?php echo $url; ?>views/js/plugins/jquery.scrollUp.js"></script>

</head>

<body>

	<?php

	/*=============================================
	CABEZOTE
	=============================================*/

	include "modulos/cabezote.php";

	/*=============================================
	CONTENIDO DINÁMICO
	=============================================*/

	$rutas = array();
	$ruta = null;
	$infoProducto = null;

	if(isset($_GET["ruta"])){

		$rutas = explode("/", $_GET["ruta"]);

		$item = "ruta";
		$valor = $rutas[0];

		/*=============================================
		URL'S AMIGABLES DE CATEGORÍAS
		=============================================*/

		$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

		if (is_array($rutaCategorias)) {

			if($rutas[0] == $rutaCategorias["ruta"]){

				$ruta = $rutas[0];
		
			}
		}
		

		/*=============================================
		URL'S AMIGABLES DE SUBCATEGORÍAS
		=============================================*/

		$rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

		foreach ($rutaSubCategorias as $key => $value) {
			
			if($rutas[0] == $value["ruta"]){

				$ruta = $rutas[0];

			}

		}
		/*=============================================
		URL'S AMIGABLES DE PRODUCTOS
		=============================================*/
		$rutaProductos = ControladorProductos::crtMostrarInfoProductos($item, $valor);
		
		if (is_array($rutaProductos)) {
			if($rutas[0] == $rutaProductos ["ruta"]){

				$infoProducto = $rutas[0];

			}
		}

		/*=============================================
		LISTA BLANCA DE URL'S AMIGABLES
		=============================================*/
		
		if($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] =="lo-mas-vendido" ||$rutas[0] == "lo-mas-visto" 	){
			
			include "modulos/producto.php";

		}else if ($infoProducto != null)  {
			
			include "modulos/infoproducto.php";
		}else{

			include "modulos/error404.php";
		}
		
	}else{
		
		include "modulos/slide.php";
		include "modulos/destacados.php";

	}

	?>
	<input type="hidden" value="<?php $url; ?>" id="rutaOculta">
	<!-- ===========================================
	JAVASCRIPT PERSONALIZADA
	================================================-->
	<script src="<?php echo $url; ?>views/js/cabezote.js"></script>
	<script src="<?php echo $url; ?>views/js/plantilla.js"></script>
	<script src="<?php echo $url; ?>views/js/slide.js"></script>

</body>
</html>