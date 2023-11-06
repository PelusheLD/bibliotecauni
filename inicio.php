<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {
	$usuario = $_SESSION["usuario"];
	$query = "SELECT * FROM visitantes WHERE usuario = '$usuario'";
	$resultado = mysqli_query($con, $query);
	$registro = mysqli_fetch_assoc($resultado);

	if ($registro['estado'] != 1) {
		echo '<script> window.location="verificacion.php"; </script>';
		$_SESSION['error'] = "Que estas intentando hacer? , se te envio otro codigo al correo y deja de estar inventando";
		exit();
	}

	$consulta = mysqli_query($con, "select * from libros limit 0,6");
	$nro_reg = mysqli_num_rows($consulta);
	if ($nro_reg == 0) {
		echo 'No Tienes Productos en la Base de Datos';
	}
	$result = mysqli_query($con, "SELECT count(utc) as visitas from visitas");
	$row = mysqli_fetch_array($result);
	$numero_visitas = $row["visitas"];
	$fechaMensaje = date("Y-m-d");
	$result2 = mysqli_query($con, "SELECT count(utc) as visitas from visitas WHERE fecha_visita = '" . $fechaMensaje . "'");
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
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script>
			var tiempoSesion = 500000; // Duración inicial de la sesión en milisegundos
			var tiempoRestante = tiempoSesion; // Tiempo restante en milisegundos
			var temporizador; // Variable para el temporizador

			// Función para mostrar el aviso y el botón de extender sesión
			function mostrarAviso() {
				Swal.fire({
					title: 'Su sesión está a punto de expirar',
					text: '¿Desea extender su sesión?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Extender Sesión',
					cancelButtonText: 'No, cerrar sesión',
					reverseButtons: true
				}).then((result) => {
					if (result.isConfirmed) {
						extenderSesion();
					} else {
						cerrarSesion();
					}
				});
			}

			// Función para extender la sesión en 30 segundos
			function extenderSesion() {
				tiempoRestante = 300000; // Restablecer el tiempo restante a 30 segundos

				// Reiniciar los temporizadores
				clearTimeout(temporizador);
				temporizador = setTimeout(mostrarAviso, tiempoRestante - 10000);
				temporizador = setTimeout(cerrarSesion, tiempoRestante);
			}

			// Temporizador para mostrar el aviso cuando falten 10 segundos
			temporizador = setTimeout(mostrarAviso, tiempoSesion - 100000);

			// Temporizador para cerrar la sesión cuando se cumpla el tiempo total
			temporizador = setTimeout(cerrarSesion, tiempoSesion);

			// Función para cerrar la sesión y redireccionar
			function cerrarSesion() {
				window.location.href = "login/logout2.php";
			}
		</script>

	</head>

	<body>
		<!--barra de correo, telefono y login-->
		<?php include('includes/header.php'); ?>
		<!--slider de imagenes-->
		<?php include('includes/slider.php'); ?>
		<section>
			<div class="container">
				<div class="row">
					<!--Menu lateral Izquierdo-->
					<?php //include ('includes/sidebarIzquierdo.php'); 
					?>
					<div class="col-sm-3"> <!--/Inicio de barra lateral izquierda-->
						<div class="left-sidebar">
							<div class="brands_products"><!--brands_products-->
								<h2>Categorias</h2>
								<div class="brands-name">
									<ul class="nav nav-pills nav-stacked">

										<?php
										$caq = mysqli_query($con, "select * from categorias");
										while ($catrow = mysqli_fetch_array($caq)) {
										?>
											<li class="divider"></li>
											<li><a href="inicio.php?cat=<?php echo $catrow['id_categoria']; ?>"><?php echo $catrow['nombre_categoria']; ?></a></li>
										<?php
										}

										?>
									</ul>
								</div>
							</div><!--/brands_products-->
							<div class="price-range"><!--price-range-->
								<h2>Visitas</h2>
								<div class="col-md-4">
									<img src="images/home/visitas.png" width="60" height="60">
								</div>
								<div class="col-md-8">
									<h5><b><?php echo $numero_visitas; ?> Visitas Totales</b></h5>
									<h6><b><?php echo $visitas_hoy; ?> Visitas Hoy</b></h6>
								</div>
							</div><!--/price-range-->
						</div>
					</div> <!--fin de barra lateral izquierda-->
					<div class="col-sm-9 padding-right">
						<!--Contenido Central donde se muestran los libros-->
						<!--Cuadros con los libros obtenidos de la base de datos-->
						<div class="features_items">
							<h2 class="title text-center">Te podria interesar</h2>
							<?php

							if (isset($_GET['cat'])) {
								$cat = $_GET['cat'];
							} else {
								$cat = "1";
								// echo "<script>alert('No tenemos libros con esa categoria')</script>";
							}
							$query = mysqli_query($con, "select * from libros where id_categoria='$cat'");
							if (mysqli_num_rows($query) < 1) {
								//echo "<script>alert('No tenemos libros con esa categoria')</script>";
								echo "<div class='col-sm-3'>";
								echo "<p style='color:red;'><b>No tenemos Libros para esta Categoria</b></p>";
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
							<br>
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
		<?php
		if (isset($_SESSION['exito'])) {
			$respuesta = $_SESSION['exito']; ?>
			<script>
				Swal.fire(
					'Exelente!',
					'<?php echo $respuesta; ?>',
					'success'
				)
			</script>
		<?php
			unset($_SESSION['exito']);
		}
		?>
		<?php
		if (isset($_SESSION['wr'])) {
			$respuesta = $_SESSION['wr']; ?>
			<script>
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					text: '<?php echo $respuesta; ?>',
				})
			</script>
		<?php
			unset($_SESSION['wr']);
		}
		?>
		<?php
		if (isset($_SESSION['error'])) {
			$respuesta = $_SESSION['error']; ?>
			<script>
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: '<?php echo $respuesta; ?>',
				})
			</script>
		<?php
			unset($_SESSION['error']);
		}
		?>
	</body>

	</html>
	<?php include "log.php"; ?>
<?php
} else {
	echo '<script> window.location="index.php"; </script>';
}
?>