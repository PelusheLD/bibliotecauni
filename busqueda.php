<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {


	$consulta = mysqli_query($con, "select * from libros limit 0,6");
	$nro_reg = mysqli_num_rows($consulta);
	if ($nro_reg == 0) {
		echo 'No Tienes Productos en la Base de Datos';
	}
	$result = mysqli_query($con, "SELECT count(utc) as visitas from visitas");
	$row = mysqli_fetch_array($result);
	$numero_visitas = $row["visitas"];
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
		<title>Biblioteca | Inicio</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<link rel="shortcut icon" href="images/iconolibreria.jpg">
	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<section>
			<div class="container">
				<div class="row">
					<br>
					<div class="col-md-3">
						<form name="busqueda" method="get" action="busqueda.php">
							<div class="search_box pull-right">
								<input type="text" placeholder="Buscar" name="buscar" required="true" />
							</div>
					</div>
					<div class="col-md-1">
						<input type="submit" name="enviar" value="Buscar Libro" class="btn btn-success">
					</div>
					</form>
					<div class="col-md-2">
						<a href="busqueda.php"><button class="btn btn-danger">Ver Todos</button></a>
					</div>
				</div>

				<div class="features_items">
					<br><br>
					<h2 class="title text-center">Listado de Libros</h2>
					<?php

					if (isset($_GET['enviar'])) {
						$busqueda = $_GET['buscar'];
						$query = mysqli_query($con, "select * from libros where nombre like '%$busqueda%' and disponible='si'");
						if (mysqli_num_rows($query) < 1) {
							//echo "<script>alert('No tenemos libros con esa categoria')</script>";
							echo "<div class='col-sm-3'>";
							echo "<p style='color:red;'><b>No tenemos libros que coincidan con este nombre</b></p>";
							echo "</div>";
						} else {
							while ($filas = mysqli_fetch_array($query)) {

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
						<?php }
						} ?>
						<?php
					} else {
						$query = mysqli_query($con, "select * from libros where disponible='si'");
						while ($filas = mysqli_fetch_array($query)) {

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
					<?php
						}
					}

					?>

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