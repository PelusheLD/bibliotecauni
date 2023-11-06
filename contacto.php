<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Biblioteca Virtual | Contacto</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/iconolibreria.jpg">
		<link rel="shortcut icon" href="images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<br>
		<div id="contact-page" class="container">
			<div class="bg">
				<div class="row">
					<div class="col-sm-12">
						<h2 class="title text-center">Nuestra Ubicacion<strong></strong></h2>
						<div id="gmap" class="contact-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d983.5752774596856!2d-69.21934117410521!3d9.569291155565418!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2sve!4v1690903276314!5m2!1ses!2sve" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
							<br>
							<small>
								<a href="https://www.google.com.ni/maps/@12.1101789,-85.3676322,17z?hl=es"><B>Ver en Mapa<B></a>
							</small>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<div class="col-sm-8">
						<div class="contact-form">
							<h2 class="title text-center">Escribenos </h2>
							<div class="status alert alert-success" style="display: none"></div>
							<form id="main-contact-form" action="funciones_php/validar_mensaje.php" class="contact-form row" name="contact-form" method="post">
								<div class="form-group col-md-6">
									<input type="text" name="nombre" class="form-control" required placeholder="Nombre">
								</div>
								<div class="form-group col-md-6">
									<input type="email" name="email" class="form-control" required placeholder="Email">
								</div>
								<div class="form-group col-md-12">
									<input type="text" name="asunto" class="form-control" required placeholder="Asunto">
								</div>
								<div class="form-group col-md-12">
									<textarea name="mensaje" id="message" required class="form-control" rows="8" placeholder="Escribe tu mensaje"></textarea>
								</div>
								<div class="form-group col-md-12">
									<input type="submit" name="submit" class="btn btn-primary pull-right" value="Enviar Mensaje">
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="contact-info">
							<h2 class="title text-center">Informacion de Biblioteca</h2>
							<address>
								<p>Biblioteca Virtual</p>
								<p>En araure, por ahi</p>
								<p>Acarigua, Portuguesa</p>
								<p>Telefono: 584515487
									44
								</p>
								<p>Celular: 5851225481584</p>
								<p>Email: unefa@gmail.com</p>
							</address>
						</div>
					</div>
				</div>
			</div>
		</div><!--/#contact-page-->
		<?php include('includes/footer.php'); ?>

		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="js/gmaps.js"></script>
		<script src="js/contact.js"></script>
		<script src="js/price-range.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/jquery.prettyPhoto.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
	<?php include "log.php"; ?>
<?php
} else {
	echo '<script> window.location="index.php"; </script>';
}
?>