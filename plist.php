<?php
session_start();
include("admin/conexion.php");
if(isset($_SESSION['usuario']))
 {
?>
<?php include ('admin/conexion.php');

$consulta=mysqli_query($con, "select * from libros limit 0,6");
$nro_reg=mysqli_num_rows($consulta);
    if ($nro_reg==0){
	echo 'No Tienes Productos en la Base de Datos';
	}
	$result=mysqli_query($con, "SELECT count(utc) as visitas from visitas");
   $row = mysqli_fetch_array($result);
    $numero_visitas = $row["visitas"];
	$result2=mysqli_query($con, "SELECT count(utc) as visitas from visitas WHERE fecha_visita = CURDATE( )");
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
    <title>Biblioteca UNI | Inicio</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">     
    <link rel="shortcut icon" href="images/iconolibreria.ico">
</head>
<body>
<!--barra de correo, telefono y login-->
<?php include ('includes/header.php');?>
<!--slider de imagenes-->
<?php include ('includes/slider.php');?>	
<section>
   <div class="container">
		<div class="row">
		<!--Menu lateral Izquierdo-->
			<?php //include ('includes/sidebarIzquierdo.php'); ?>
			<div class="col-sm-3"> <!--/Inicio de barra lateral izquierda-->
	<div class="left-sidebar">				
	    <div class="brands_products"><!--brands_products-->
			<h2>Categorias</h2>
			<div class="brands-name">
				<ul class="nav nav-pills nav-stacked">
				<?php
							$caq=mysqli_query($con,"select * from categorias");
							while($catrow=mysqli_fetch_array($caq)){
								?>
								<li class="divider"></li>
								<li><a href="plist.php?cat=<?php echo $catrow['id_categoria']; ?>"><?php echo $catrow['nombre_categoria']; ?></a></li>
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
					<h5><b><?php  echo $numero_visitas;?> Visitas Totales</b></h5>
					<h6><b><?php  echo $visitas_hoy;?> Visitas Hoy</b></h6>
				</div>
			</div><!--/price-range-->					
	</div>
</div> <!--fin de barra lateral izquierda-->
			<div class="col-sm-9 padding-right">
				
				<!--Cuadros con los libros obtenidos de la base de datos-->
                <div class="features_items">
				<h2 class="title text-center">Libros mas Descargados</h2>

        <?php
        if (isset($_GET['cat'])) {
         $cat=$_GET['cat'];
        }
        else{
        $cat = "";	
        }
		$inc=4;
		$query=mysqli_query($con,"select * from libors where id_categoria='$cat'");
		while($row=mysqli_fetch_array($query)){
			
			$inc = ($inc == 4) ? 1 : $inc+1; 
			if($inc == 1) echo "<div class='row'>";  
			
			?>
				<div class="col-lg-3">
				<div>
					<img src="../<?php if (empty($row['foto'])){echo "images/libros/product1.jpg";}else{echo $row['foto'];} ?>" style="width: 230px; height:230px; padding:auto; margin:auto;" class="thumbnail">
					<div style="height: 10px;"></div>
					<div style="height:40px; width:230px; margin-left:17px;"><?php echo $row['nombre']; ?></div>
				</div>
				</div>
			<?php
		if($inc == 4) echo "</div><div style='height: 30px;'></div>";
		}
		if($inc == 1) echo "<div class='col-lg-3></div><div class='col-lg-3'></div><div class='col-lg-3'></div></div>"; 
		if($inc == 2) echo "<div class='col-lg-3'></div><div class='col-lg-3'></div></div>"; 
		if($inc == 3) echo "<div class='col-lg-3'></div></div>"; 
	?>
               <!--Contenido Central donde se muestran los libros-->

			   <?php
		     	while($filas=mysqli_fetch_array($consulta)){
				$id=$filas['id_libro'];
				$foto=$filas['foto'];
				$nombre=$filas['nombre'];
				$descripcion=$filas['descripcion'];
				?>
			   <div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
						<img src="admin/<?php echo $foto ?>" width="100" heigth="90">	 <p><?php echo $nombre ?></p>
						    <p><?php echo $descripcion ?></p>
						    </div>
							    <div class="product-overlay">
									<div class="overlay-content">
						<img src="admin/<?php echo $foto ?>" width="150" heigth="150">
									<p><?php echo $nombre ?></p>
									<a href="admin/pdf/archivo.php?id=<?php echo $filas['id_libro']?>" class="btn btn-default add-to-cart">
									<i class="fa fa-download"></i>Ver y Descargar</a>
                                     </div>
								</div>
					    </div>
					</div>
			   </div>	
				<?php } ?>	
				</div><!--Datos obtenidos de la base de datos-->
					<!--Tabs-->
			     	<?php include ('includes/tabs.php');?> 
					<!--slider de abajo-->
					<?php include ('includes/sliderInferior.php');?> 					
				</div>
			</div>
		</div>
	</section>
	<!--pie de pagina-->
<?php include ('includes/footer.php');?>
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
}else{
    echo '<script> window.location="index.php"; </script>';
}
?>