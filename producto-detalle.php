<?php
session_start();
include("admin/conexion.php");
if (isset($_SESSION['usuario'])) {
?>
	<?php include('admin/conexion.php');

	//consulta para contar las visitas de la pagina almacenadas en la base de datos
	$result = mysql_query("SELECT count(utc) as visitas from visitas");
	$row = mysql_fetch_array($result);
	$numero_visitas = $row["visitas"];

	//consulta para contar las visitas del dia de hoy
	$result2 = mysql_query("SELECT count(utc) as visitas from visitas WHERE fecha_visita = CURDATE( )");
	$row2 = mysql_fetch_array($result2);
	$visitas_hoy = $row2["visitas"];

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Product Details | E-Shopper</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/font-awesome.min.css" rel="stylesheet">
		<link href="css/prettyPhoto.css" rel="stylesheet">
		<link href="css/price-range.css" rel="stylesheet">
		<link href="css/animate.css" rel="stylesheet">
		<link href="css/main.css" rel="stylesheet">
		<link href="css/responsive.css" rel="stylesheet">
		<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
		<link rel="shortcut icon" href="images/ico/favicon.ico">
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
	</head><!--/head-->

	<body>
		<!--encabezado-->
		<?php include('includes/header.php'); ?>
		<br>
		<br>
		<section>
			<div class="container">
				<div class="row">
					<?php include('includes/sidebarIzquierdo.php'); ?>
					<div class="col-sm-9 padding-right">

						<?php
						include('admin/conexion.php');

						$sql = "SELECT libros.id_libro, libros.foto, libros.nombre, libros.descripcion, libros.disponible, categorias.nombre_categoria as categoria,
			          subcategorias.nombre_subcategoria as subcategoria, proveedor.nombre_proveedor as proveedor FROM libros
                      INNER JOIN categorias ON libros.id_categoria = categorias.id_categoria
                      INNER JOIN proveedor ON libros.id_proveedor = proveedor.id_proveedor
                      INNER JOIN subcategorias ON libros.id_subcategoria = subcategorias.id_subcategoria
                      where libros.id_libro =" . $_GET['id'];
						$nro_reg = mysql_num_rows($sql);
						if ($nro_reg == 0) {
							echo 'No Tienes Libros';
						}

						while ($filas = mysql_fetch_array($sql)) {
							$id = $filas['id_libro'];
							$foto = $filas['foto'];
							$nombre = $filas['nombre'];
							$descripcion = $filas['descripcion'];
							$disponible = $filas['disponible'];
							$categoria = $filas['categoria'];
							$subcategoria = $filas['subcategoria'];
							$proveedor = $filas['proveedor'];

						?>
							<div class="product-details"><!--product-details-->
								<div class="col-sm-5">
									<div class="view-product">
										<img src="admin/<?php echo $foto ?>" alt="" />
									</div>

								</div>

								<div class="col-sm-7">
									<div class="product-information"><!--/informacion del libro-->
										<img src="admin/<?php echo $foto ?>" class="newarrival" alt="" />
										<h2><?php echo $nombre ?></h2>
										<p><?php echo $descripcion ?></p>
										<p>Puntuacion:</p>
										<img src="images/product-details/rating.png" alt="" />
										<br>
										<span>
											<button type="button" class="btn btn-fefault cart">
												<i class="fa fa-download"></i> Descargar</button>
										</span>
										<span>
											<button type="button" class="btn btn-fefault cart">
												<i class="fa fa-download"></i> Pedir Prestado</button>
										</span>
										<p><b>Disponible: </b> <?php echo $disponible ?></p>
										<p><b>Categoria: </b> <?php echo $categoria ?></p>
										<p><b>Subcategoria:</b> <?php echo $subcategoria ?></p>
										<a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
									</div><!--/informacion del libro-->
								</div>
							</div><!--/product-details-->

						<?php } ?>

						<?php include('includes/sliderInferior.php'); ?>
					</div>
				</div>
			</div>
		</section>
		<!--pie de pagina-->
		<?php include('includes/footer.php'); ?>
		<script src="js/jquery.js"></script>
		<script src="js/price-range.js"></script>
		<script src="js/jquery.scrollUp.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.prettyPhoto.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php
} else {
	echo '<script> window.location="index.php"; </script>';
}
?>