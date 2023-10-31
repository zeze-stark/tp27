<?php
include("./classes/post.php");
include("./classes/comment.php");
include("./config/config.php");

$post = new Post($db);
$comments = new Comment($db);

$arrPosts = $post->getPosts();

function formatDate($date)
{
	$arrDate = explode(" ", $date);
	echo str_replace("-", ".", $arrDate[0]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Blog del Curso PHP></title>
	<meta name="title" content="Blog del Curso PHP">
	<meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur dolores, quae officia impedit veniam tenetur. A id, qui eaque tenetur officia odit iure, obcaecati doloribus libero ipsam ea et provident prueba">
	<meta name="keywords" content=juanito, travel, viajes, mochileros, vuelta al mundo, sudamerica, norteamerica, palabra">
	<meta property="og:site_name" content="Blog del viajero" />
	<meta property="og:title" content="Blog del Curso PHP">
	<meta property="og:description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur dolores, quae officia impedit veniam tenetur. A id, qui eaque tenetur officia odit iure, obcaecati doloribus libero ipsam ea et provident prueba">
	<meta property="og:type" content="Type">
	<meta property="og:image" content="public/vistas/img/articulo01.png">
	<meta property="og:url" content="http://localhost/tp27-main/">
	<link rel="icon" href="public/vistas/img/icono.jpg">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<link href="https://fonts.googleapis.com/css?family=Chewy|Open+Sans:300,400" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.0/css/all.css" integrity="sha384-aOkxzJ5uQz7WBObEZcHvV5JvRW3TUc2rNPA7pe3AwnsUohiw1Vj2Rgx2KSOkF5+h" crossorigin="anonymous">

	<!-- JdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<link rel="stylesheet" href="public/vistas/css/plugins/jquery.jdSlider.css">

	<!-- Alertas Notie -->
	<link rel="stylesheet" href="public/vistas/css/plugins/notie.min.css">


	<link rel="stylesheet" href="public/vistas/css/style.css">

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
	<script src="public/vistas/js/plugins/jquery.jdSlider-latest.js"></script>

	<!-- paginaton -->
	<!-- http://osecebe.github.io/twbs-pagination/ -->
	<script src="public/vistas/js/plugins/pagination.min.js"></script>
	<!-- scrollu -->
	<!-- https:/markgoodyear.com/labs/scrollup/ -->
	<!-- https:/easings.net/es# -->
	<script src="public/vistas/js/plugins/scrollUP.js"></script>
	<script src="public/vistas/js/plugins/jquery.easing.js"></script>

	<script src="public/vistas/js/plugins/shape.share.js"></script>
	<!-- Alertas Notie-->
	<script src="public/vistas/js/plugins/notie.min.js"></script>

</head>

<body>
	<header class="container-fluid d-flex justify-content-between p-3 px-4">
		<h3 class="text-light">Blog</h3>
		<nav class="align-items-center logged">
			<p class="text-light"> Bienvenido <b><span id="username"></span></b></p>
			<button onclick="localStorage.removeItem('userBlog');window.location.href='./'" type="button" class="btn btn-danger mx-3">
				Salir
			</button>
		</nav>
		<nav class="align-items-center noLogged">
			<button type="button" class="btn btn-dark mx-3" data-toggle="modal" data-target="#modalRegistro">
				Registrarse
			</button>
			<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form id="formRegistro" class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Registrarse</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="usuario_registro">Usuario</label>
								<input type="text" class="form-control" id="usuario_registro" name="usuario_registro" placeholder="Ingresa tu usuario...">
							</div>
							<div class="form-group">
								<label for="email_registro">Email</label>
								<input type="email" class="form-control" id="email_registro" name="email_registro" placeholder="Ingresa tu email...">
							</div>
							<div class="form-group">
								<label for="password_registro">Password</label>
								<input type="password" class="form-control" id="password_registro" name="password_registro" placeholder="Ingresa tu clave...">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Registrarse</button>
						</div>
					</form>
				</div>
			</div>
			<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modalLogin">
				Iniciar Sesion
			</button>
			<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<form id="formLogin" class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Iniciar Sesion</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="usuario_login">Usuario</label>
								<input type="text" class="form-control" id="usuario_login" name="usuario_login" placeholder="Ingresa tu usuario...">
							</div>
							<div class="form-group">
								<label for="password_login">Password</label>
								<input type="password" class="form-control" id="password_login" name="password_login" placeholder="Ingresa tu clave...">
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success">Ingresar</button>
						</div>
					</form>
				</div>
			</div>
		</nav>
	</header>

	<div class="container-fluid bg-white contenidoInicio pb-4 mt-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
					<?php
					$i = 0;
					foreach ($arrPosts as $post) { ?>
						<?php $arrComments = $comments->getCommentsForPost($post['id_post']); ?>
						<div class="row">
							<div class="col-12 col-lg-5">
								<img src="public/vistas/img/articulos/articulo-10/articulo10.jpg" alt="Titulo del Articulo 60" class="img-fluid" width="100%" />
							</div>
							<div class="col-12 col-lg-7 introArticulo">
								<h4 class="d-none d-lg-block"><?php echo $post['title']; ?></h4>
								<p class="my-2 my-lg-5"><?php echo $post['content']; ?>
								</p>
								<button type="button" class="btn btn-dark mx-3" data-toggle="modal" data-target="#modalComentarios<?php echo $i; ?>">
									Ver Comentarios
								</button>
								<div class="modal fade" id="modalComentarios<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php foreach ($arrComments as $comment) { ?>
													<h4><?php echo $comment['author_id']; ?></h4>
													<p><?php echo $comment['content']; ?></p>
												<?php } ?>
											</div>

											<form class="formComentario modal-footer d-flex flex-row">
												<input type="text" style="display:none;" id="postId" value="<?php echo $post['id_post']; ?>" />
												<input type="text" name="comentario" id="comentario" class="form-control">
												<button type="submit" class="btn btn-success">Enviar</button>
											</form>

										</div>
									</div>
								</div>
								<div class="fecha"><?php formatDate($post['created_at']); ?></div>
							</div>
						</div>
						<hr class="mb-4 mb-lg-5" style="border: 1px solid #79FF39">
					<?php
						$i++;
					} ?>

				</div>

				<!-- COLUMNA DERECHA -->

				<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">

					<!-- SOBRE MI -->

					<div class="sobreMi">

						<h4>Sobre Nosotros</h4>

						<img src="https://fmn.unsl.edu.ar/wp-content/uploads/2023/05/banner-ok-argentina-programa-1030x335.jpg" alt="Lorem ipsum dolor sit amet" class="img-fluid my-1">

						<p class="small">SOMOS 3 ESTUDIANTES DE ARGENTINA PROGRAMA 4.0, HACIENDO UN BLOG PARA EL TRABAJO FINAL DE LA ULTIMA CLASE.</p>

					</div>
					<!-- Artículos destacados -->

					<div class="my-4">
						<h4>Artículos Destacados</h4>

						<div class="d-flex my-3">
							<div class="w-100 w-xl-50 pr-3 pt-2">
								<a href="asia/type-something-here-lorem60">
									<img src="public/vistas/img/articulos/articulo-10/articulo10.jpg" alt="Titulo del Articulo 60" class="img-fluid">
								</a>
							</div>
							<div>
								<a href="asia/type-something-here-lorem60" class="text-secondary">
									<p class="small">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut sed aperiam neque...</p>
								</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
	<footer class="container-fluid py-4 d-none d-md-block">
		<div class="w-100 m-auto">
			<ul class="d-flex justify-content-center align-items-center">
				<li>
					<a href="https://www.facebook.com/" target="_blank">
						<i class="fab fa-facebook-f lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/" target="_blank">
						<i class="fab fa-instagram lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
				<li>
					<a href="https://www.twitter.com/" target="_blank">
						<i class="fab fa-twitter lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
				<li>
					<a href="https://www.youtube.com/" target="_blank">
						<i class="fab fa-youtube lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
				<li>
					<a href="https://www.snapchat.com/" target="_blank">
						<i class="fab fa-snapchat-ghost lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
				<li>
					<a href="https://www.linkedin.com" target="_blank">
						<i class="fab fa-linkedin-in lead text-white mr-3 mr-sm-4"></i>
					</a>
				</li>
			</ul>
		</div>
		<p class="text-center text-light">Copyright © Argentina Programa - Octubre 2023</p>
	</footer>

	<input type="hidden" id="rutaActual" value="">
	<script src="./javaYcss/appcomentario.js"></script>
	<script src="./javaYcss/applogin.js"></script>

	<script src="./javaYcss/app.js"></script>

</body>

</html>