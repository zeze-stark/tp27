
<?php

$blog = ControladorBlog::ctrMostrarBlog(); 
$categorias = ControladorBlog::ctrMostrarCategorias(null, null); 
$articulos = ControladorBlog::ctrMostrarConInnerJoin(0,5,null,null);
$totalArticulos = ControladorBlog::ctrMostrarTotalArticulos(null,null);

$totalPaginas = ceil(count($totalArticulos)/5);


?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php

	$validarRuta = "";
	
	   if(isset($_GET["pagina"])){

			$rutas = explode("/", $_GET["pagina"]);

			foreach ($categorias as $key => $value) {
			
					
				if(!is_numeric($rutas[0]) && $rutas[0] == $value["ruta_categoria"]  ){

					$validarRuta = "categorias";

					break;
				}

			}

			if(isset($rutas[1])){
				
				foreach ($totalArticulos as $key => $value) {
			
					
					if(!is_numeric($rutas[1]) && $rutas[1] == $value["ruta_articulo"]  ){
	
						$validarRuta = "articulos";
	
						break;
					}
	
				}

			}
				
		if($validarRuta == "categorias"){

				echo '<title>'.$blog["titulo"].' | '.$value["descripcion_categoria"].'></title>

				<meta name = "title" content="'.$value["titulo_categoria"].'>">
				<meta name = "description" content="'.$value["descripcion_categoria"].'">';
				/* palabras claves, desde la BD viene como un json, entonces debemos decodificarlo para mostrarlo */
				$palabras_claves = json_decode($value["p_claves_categoria"],true);

				$p_claves = "";

				echo '<meta name = "keywords" content="'.$p_claves.'">';

				echo '<meta property="og:site_name" content="'.$value["titulo_categoria"].'">
				<meta property="og:title" content="'.$value["titulo_categoria"].'">
				<meta property="og:description" content="'.$value["descripcion_categoria"].'">
				<meta property="og:type" content="Type">
				<meta property="og:image" content="'.$blog["dominio"].$value["img_categoria"].'">
				<meta property="og:url" content="'.$blog["dominio"].$value["ruta_categoria"].'">';
				

				foreach ($palabras_claves as $key => $value){

					$p_claves .= $value.", ";
				}
				/* substr quita string de una cadena, el 0 es que del principio no sacamos nada y -2 quita dos lugares del final, es decir el espacio  y la coma que asignamos al ultimo elemento de $p_claves*/

				$p_claves = substr($p_claves,0,-2);

			

		}else	if($validarRuta == "articulos"){

			echo '<title>'.$blog["titulo"].' | '.$value["titulo_articulo"].'></title>

			<meta name = "title" content="'.$value["titulo_articulo"].'>">
			<meta name = "description" content="'.$value["descripcion_articulo"].'">';
			/* palabras claves, desde la BD viene como un json, entonces debemos decodificarlo para mostrarlo */
			$palabras_claves = json_decode($value["p_claves_articulo"],true);

			$p_claves = "";

			echo '<meta property="og:site_name" content="'.$value["titulo_articulo"].'">
				<meta property="og:title" content="'.$value["titulo_articulo"].'">
				<meta property="og:description" content="'.$value["descripcion_articulo"].'">
				<meta property="og:type" content="Type">
				<meta property="og:image" content="'.$blog["dominio"].$value["portada_articulo"].'">
				<meta property="og:url" content="'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"].'">';

			foreach ($palabras_claves as $key => $value){

				$p_claves .= $value.", ";
			}
			/* substr quita string de una cadena, el 0 es que del principio no sacamos nada y -2 quita dos lugares del final, es decir el espacio  y la coma que asignamos al ultimo elemento de $p_claves*/

			$p_claves = substr($p_claves,0,-2);

			echo '<meta name = "keywords" content="'.$p_claves.'">';



	}else{

				echo '<title>'.$blog["titulo"].'></title>

				<meta name = "title" content="'.$blog["titulo"].'>">
				<meta name = "description" content="'.$blog["descripcion"].'">';
				/* palabras claves, desde la BD viene como un json, entonces debemos decodificarlo para mostrarlo */
				$palabras_claves = json_decode($blog["palabras_claves"],true);

				$p_claves = "";

				echo '<meta property="og:site_name" content="'.$blog["titulo"].'>
				<meta property="og:title" content="'.$blog["titulo"].'">
				<meta property="og:description" content="'.$blog["descripcion"].'">
				<meta property="og:type" content="Type">
				<meta property="og:image" content="'.$blog["dominio"].$blog["portada"].'">
				<meta property="og:url" content="'.$blog["dominio"].'">';

				foreach ($palabras_claves as $key => $value){

					$p_claves .= $value.", ";
				}
				/* substr quita string de una cadena, el 0 es que del principio no sacamos nada y -2 quita dos lugares del final, es decir el espacio  y la coma que asignamos al ultimo elemento de $p_claves*/

				$p_claves = substr($p_claves,0,-2);

				echo '<meta name = "keywords" content='.$p_claves.'">';	


			}
		
   }else{

		echo '<title>'.$blog["titulo"].'></title>

				<meta name = "title" content="'.$blog["titulo"].'>">
				<meta name = "description" content="'.$blog["descripcion"].'">';
				/* palabras claves, desde la BD viene como un json, entonces debemos decodificarlo para mostrarlo */
				$palabras_claves = json_decode($blog["palabras_claves"],true);

				$p_claves = "";

				foreach ($palabras_claves as $key => $value){

					$p_claves .= $value.", ";
				}
				/* substr quita string de una cadena, el 0 es que del principio no sacamos nada y -2 quita dos lugares del final, es decir el espacio  y la coma que asignamos al ultimo elemento de $p_claves*/

				$p_claves = substr($p_claves,0,-2);

		echo '<meta name = "keywords" content='.$p_claves.'">';

		echo '<meta property="og:site_name" content="'.$blog["titulo"].'>
		<meta property="og:title" content="'.$blog["titulo"].'">
		<meta property="og:description" content="'.$blog["descripcion"].'">
		<meta property="og:type" content="Type">
		<meta property="og:image" content="'.$blog["dominio"].$blog["portada"].'">
		<meta property="og:url" content="'.$blog["dominio"].'">';

	}


	?>

	<link rel="icon" href="<?php echo $blog["dominio"];?><?php echo $blog["icono"]?>">

	<!--=====================================
	PLUGINS DE CSSvistas/
	======================================-->
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Chewy|Open+Sans:300,400" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<link rel="stylesheet" href="<?php echo $blog["dominio"];?>vistas/css/plugins/jquery.jdSlider.css">

		<!-- Alertas Notie -->
		<link rel="stylesheet" href="<?php echo $blog["dominio"];?>vistas/css/plugins/notie.min.css">


	<link rel="stylesheet" href="<?php echo $blog["dominio"];?>vistas/css/style.css">

	<!--=====================================
	PLUGINS DE JS
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/jquery.jdSlider-latest.js"></script>

	<!-- paginaton -->
	<!-- http://osecebe.github.io/twbs-pagination/ -->
	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/pagination.min.js"></script>
	<!-- scrollu -->
	<!-- https:/markgoodyear.com/labs/scrollup/ -->
	<!-- https:/easings.net/es# -->
	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/scrollUP.js"></script>
	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/jquery.easing.js"></script>

	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/shape.share.js"></script>
	<!-- Alertas Notie-->
	<script src="<?php echo $blog["dominio"];?>vistas/js/plugins/notie.min.js"></script>

</head>

<body>

<?php

	// Modulos fijos superiores
   include "paginas/modulos/cabecera.php";
   include "paginas/modulos/redes-sociales-movil.php";
   include "paginas/modulos/buscardor-movil.php";
   include "paginas/modulos/menu.php"; 

   // Navegar entre paginas

	$validarRuta ="";

   	if(isset($_GET["pagina"])){

				$rutas = explode("/",$_GET["pagina"]);

				if(is_numeric($rutas[0])){

					$desde = ($rutas[0]-1)*5;

					$cantidad = 5;

					$articulos = ControladorBlog::ctrMostrarConInnerJoin($desde,$cantidad,null, null);

			}else{

				foreach ($categorias as $key => $value) {
					
						if($rutas[0] == $value["ruta_categoria"]){

								$validarRuta = "categorias";

								break;

						}else if ($rutas[0] == "sobre-mi"){

							$validarRuta = "sobre-mi";

							break;

					}else{

							$validarRuta = "buscador";

						}
				}

			}

				//Indice 1: Rutasde articulos o paginación de categoria

				if(isset($rutas[1])){

							if(is_numeric($rutas[1])){

										$desde = ($rutas[1]-1)*5;
					
										$cantidad = 5;
					
										$articulos = ControladorBlog::ctrMostrarConInnerJoin($desde,$cantidad,null, null);
					
						}else{
			
							foreach ($totalArticulos as $key => $value) {
								
									if($rutas[1] == $value["ruta_articulo"]){
			
											$validarRuta = "articulos";
			
											break;
									}
							}
			
						}


				}

		     //validar la ruta

				if($validarRuta == "categorias"){
				
								include "paginas/categorias.php";
				
				}else if($validarRuta == "buscador"){

									include "paginas/buscador.php";
				
				}else if($validarRuta == "sobre-mi"){

									include "paginas/sobre-mi.php";
				
				}else if($validarRuta == "articulos"){

				    		include "paginas/articulos.php";
				
				}else if(is_numeric($rutas[0]) && $rutas[0] <= $totalPaginas){

								include "paginas/inicio.php";

				}else if(isset($rutas[1]) && is_numeric($rutas[1])){

								include "paginas/inicio.php";
				}else if(isset($rutas[1]) && !is_numeric($rutas[1])){

					include "paginas/404.php";
				}else{

					include "paginas/404.php";
				}

					
				
		}else{

				include "paginas/inicio.php";

	   }
   
   

	// Modulos fijos inferiores
   include "paginas/modulos/footer.php";
?>

<input type="hidden" id="rutaActual" value="<?php echo $blog["dominio"];?>">
<script src="<?php echo $blog["dominio"];?>vistas/js/script.js"></script>


</body>
</html>