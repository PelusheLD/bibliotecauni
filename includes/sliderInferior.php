

        <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Libros Nuevos</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<?php
include ('admin/conexion.php');
$query=mysqli_query($con,"SELECT * FROM libros WHERE fecha_ingreso BETWEEN DATE_SUB( CURDATE(), INTERVAL 36 MONTH ) AND CURDATE( ) limit 0,6");
		if (mysqli_num_rows($query) < 1) {
		//echo "<script>alert('No tenemos libros con esa categoria')</script>";
		 echo "<div class='col-sm-3'>";  
		 echo "<p style='color:red;'><b>No tenemos Libros para esta Categoria</b></p>"; 
		 echo "</div>";   	
		}
		else{
		while($row=mysqli_fetch_array($query)){
			
		        $id=$row['id_libro'];
				$foto=$row['foto'];
				$nombre=$row['nombre'];
				$descripcion=$row['descripcion']; 	
			?>
													<img src="admin/<?php echo $foto ?>" width="100" heigth="90">
													<p><?php echo $nombre ?></p>
												<a href="admin/pdf/archivo.php?id=<?php echo $row['id_libro']?>" class="btn btn-default add-to-cart">
									             <i class="fa fa-download"></i>Ver y Descargar</a>
												</div>
												
											</div>
										</div>
									</div>
									 <?php } } ?>
									
								</div>
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->