<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {
?>
	<?php include('admin/conexion.php');

	//consulta para extraer la informacion de los libros en la base de datos
	$consulta = mysqli_query($con, "select * from libros where id_categoria = 12 limit 0,6");
	$nro_reg = mysqli_num_rows($consulta);
	if ($nro_reg == 0) {
		echo 'No Tienes Productos en la Base de Datos';
	}

	//consulta para contar las visitas de la pagina almacenadas en la base de datos
	$result = mysqli_query($con, "SELECT count(utc) as visitas from visitas");
	$row = mysqli_fetch_array($result);
	$numero_visitas = $row["visitas"];

	//consulta para contar las visitas del dia de hoy
	$result2 = mysqli_query($con, "SELECT count(utc) as visitas from visitas WHERE fecha_visita = CURDATE( )");
	$row2 = mysqli_fetch_array($result2);
	$visitas_hoy = $row2["visitas"];

	?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="biblioteca virtual UNI">
		<title>Libros Sistemas</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/iconolibreria.jpg">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	</head>

	<body>
		<!--barra de correo, telefono y login-->
		<?php include('includes/header.php'); ?>
		<!--slider de imagenes-->
		<?php //include ('includes/slider.php');
		?>
		<br>
		<div class="container">
			<div class="row">

				<div class="col-md-7">
					<img src="images/sistemas.jpg" width="600" height="300">
				</div>

				<div class="col-md-5">
					<h3>Libros sobre Ingenieria de sistemas</h3>
					<p>
						Estos son algunos de los Libros que puedes aprender a desarrollar programas, aplicaciones moviles, aplicaciones de escritorio,
						sitios web dinamicos, sistemas de informacion empresariales, entre otras cosas, el stock actual de libros es poco pero a
						medida que pase el tiempo se irán agregando mas libros en esta biblioteca.
					</p>
				</div>

			</div>
		</div>
		<br>
		<br>
		<section>
			<div class="container">
				<div class="row">
					<!--Menu lateral Izquierdo-->
					<?php //include ('includes/sidebarIzquierdo.php'); 
					?>
					<div class="col-sm-9 padding-right">

						<!--Contenido Central donde se muestran los libros-->
						<!--Cuadros con los libros obtenidos de la base de datos-->
						<div class="features_items">
							<h2 class="title text-center">Libros Disponibles</h2>
							<?php
							while ($filas = mysqli_fetch_array($consulta)) {

								$id = $filas['id_libro'];
								$nombre = $filas['nombre'];
								$ejemplares = $filas['ejemplares'];
								$circulante = $filas['circulante'];
								$descripcion = $filas['descripcion'];
							?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<h3><?php echo $nombre ?></h3>
												<p>Ejemplares <?php echo $ejemplares ?></p>
												<p>Circulante <?php echo $circulante ?></p>
												<p><?php echo $descripcion ?></p>
											</div>
											<div class="product-overlay">
												<div class="overlay-content">
													<p><?php echo $nombre ?></p>
													<a href="admin/pdf/archivo.php?id=<?php echo $filas['id_libro'] ?>" class="btn btn-default add-to-cart"><i class="fa fa-download"></i>Ver y Descargar</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

						</div><!--Datos obtenidos de la base de datos-->
					</div>
				</div>
			</div>
		</section>
		<!--pie de pagina-->
		<?php include('includes/footer.php'); ?>
		<!--Librerias de Jquery, Bootstrap y otras mas-->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/price-range.js"></script>
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