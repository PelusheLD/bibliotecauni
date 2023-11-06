<?php
include("admin/conexion.php");
$usuario = $_SESSION['usuario'];
$nombreCompleto = $_SESSION['nombreCompleto'];
$email = $_SESSION['email'];
$cedula = $_SESSION['cedula'];
$prefijo = $_SESSION['prefijo'];
$telefono = $_SESSION['telefono'];
$direccion = $_SESSION['direccion'];
$provincia = $_SESSION['provincia'];
$estadoPais = $_SESSION['estadoPais'];
$edad = $_SESSION['edad'];
$sexo = $_SESSION['sexo'];
$pais = $_SESSION['pais'];

?>
<header id="header"><!--header-->
	<script src="../login/js.js"></script>

	<div class="header_top"><!--header de arriba-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +0255896657</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> unefa@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-->
	<div class="modal fade" id="usuarioModal" tabindex="-1" role="dialog" aria-labelledby="usuarioModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="usuarioModalLabel">Información del Usuario</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Nombre Completo:</th>
								<td><?php echo $nombreCompleto; ?></td>
							</tr>
							<tr>
								<th scope="row">Cedula:</th>
								<td><?php echo $cedula; ?></td>
							</tr>
							<tr>
								<th scope="row">Usuario:</th>
								<td><?php echo $usuario; ?></td>
							</tr>
							<tr>
								<th scope="row">Email:</th>
								<td><?php echo $email; ?></td>
							</tr>
							<tr>
								<th scope="row">Telefono:</th>
								<td><?php echo $prefijo, "-", $telefono; ?></td>
							</tr>
							<tr>
								<th scope="row">Direccion:</th>
								<td><?php echo $direccion; ?></td>
							</tr>
							<tr>
								<th scope="row">Ciudad:</th>
								<td><?php echo $provincia; ?></td>
							</tr>
							<tr>
								<th scope="row">Estado Pais:</th>
								<td><?php echo $estadoPais; ?></td>
							</tr>
							<tr>
								<th scope="row">Edad:</th>
								<td><?php echo $edad; ?></td>
							</tr>
							<tr>
								<th scope="row">Sexo:</th>
								<td><?php echo $sexo; ?></td>
							</tr>
							<tr>
								<th scope="row">Pais:</th>
								<td><?php echo $pais; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Editar Usuario</button>
				</div>
			</div>
		</div>
	</div>

	<div class="header-middle"><!--header central-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="logo pull-left">
						<a href="inicio.php"><img src="images/home/logoBiblioteca.jpg" alt="" width="50px" height="50px" /></a>
					</div>

				</div>
				<div class="col-sm-8">
					<div class="shop-menu pull-right">
						<ul class="nav navbar-nav">
							<li>
								<a href="#" data-toggle="modal" data-target="#usuarioModal"><i class="fa fa-fw fa-user"></i>Usuario:<b style="color:green;"> <?php echo $usuario; ?></b></a>
							<li><a href="login/login.php"><i class="fa fa-lock"></i> Administracion</a></li>
							<li><a href="login/logout2.php"><i class="fa fa-power-off"></i> Salir</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header-->

	<div class="header-bottom"><!--header de abajo-->
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="mainmenu pull-left">
						<ul class="nav navbar-nav collapse navbar-collapse">
							<li><a href="inicio.php" class="active">Inicio</a></li>
							<li class="dropdown"><a href="#">Libros<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="libros_programacion.php">Programacion</a></li>
									<li><a href="libros_informatica.php">Informatica</a></li>
									<li><a href="libros_sistemas.php">Ingeneria de Sistemas</a></li>
									<li><a href="libros_bd.php">Base de Datos</a></li>
									<li><a href="libros_web.php">Diseño Web</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#">Servicios<i class="fa fa-angle-down"></i></a>
								<ul role="menu" class="sub-menu">
									<li><a href="prestamos.php">Prestamos de Libros</a></li>
									<li><a href="biblionline.php">Biblioteca Online</a></li>
									<li><a href="hemeroteca.php">Hemeroteca</a></li>
								</ul>
							</li>
							<li><a href="contacto.php">Contacto</a></li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div><!--/header-->
	<div class="modal fade" id="editModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="background: #3A54C8; color: white;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Actualizar Usuario</h4>
				</div>
				<form name="editUser" method="post" action="funciones_php/actualizarUsuario.php">
					<div class="modal-body">
						<div>
							<div class="row">
								<div class="col-md-3"><label>Nombre:</label></div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" placeholder="Nombre Completo" pattern="[A-Z\s]+" value="<?php echo $nombreCompleto; ?>" oninput="this.value = this.value.toUpperCase()">
								</div>
							</div>
							<div class="row">

								<div class="col-md-3"><label>Cedula:</label></div>
								<div class="col-md-9">
									<input type="number" class="form-control" name="cédula" required="required" placeholder="Cedula" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, 8);" value="<?php echo $cedula; ?>" readonly>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label>Email:</label>
								</div>
								<div class="col-md-9">
									<input type="email" class="form-control" name="email" required="required" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Por favor ingrese una dirección de correo electrónico válida" value="<?php echo $email; ?>" oninput="this.value.toLowerCase()">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label>Teléfono:</label>
								</div>
								<div class="col-md-5" style="display: flex;">
									<select class="form-control" name="prefijo" required="required" style="width: 150px; margin-right: 10px;">
										<option value="">Seleccione</option>
										<option value="0412" <?php if ($prefijo === "412") echo "selected"; ?>>0412</option>
										<option value="0416" <?php if ($prefijo === "416") echo "selected"; ?>>0416</option>
										<option value="0426" <?php if ($prefijo === "426") echo "selected"; ?>>0426</option>
										<option value="0414" <?php if ($prefijo === "414") echo "selected"; ?>>0414</option>
										<option value="0424" <?php if ($prefijo === "424") echo "selected"; ?>>0424</option>
									</select>

									<div class="row">
										<div class="col-md-12">
											<input type="number" class="form-control" name="telefono" required="required" placeholder="Teléfono" style="width: 250px;" oninput="javascript: if (this.value.length > 7) this.value = this.value.slice(0, 7);" value="<?php echo $telefono; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Direccion:</label></div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="direccion" required="required" placeholder="Direccion" value="<?php echo $direccion; ?>" oninput="this.value = this.value.toUpperCase()">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Ciudad:</label></div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="provincia" required="required" placeholder="Ciudad" value="<?php echo $provincia; ?>" oninput="this.value = this.value.toUpperCase()">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Estado Pais:</label></div>
								<div class="col-md-9">
									<select class="form-control" name="estadoPais" required>
										<option value="">Seleccione un estado</option>
										<option value="Amazonas" <?php if ($estadoPais === "Amazonas") echo "selected"; ?>>Amazonas</option>
										<option value="Anzoátegui" <?php if ($estadoPais === "Anzoátegui") echo "selected"; ?>>Anzoátegui</option>
										<option value="Apure" <?php if ($estadoPais === "Apure") echo "selected"; ?>>Apure</option>
										<option value="Aragua" <?php if ($estadoPais === "Aragua") echo "selected"; ?>>Aragua</option>
										<option value="Barinas" <?php if ($estadoPais === "Barinas") echo "selected"; ?>>Barinas</option>
										<option value="Bolívar" <?php if ($estadoPais === "Bolívar") echo "selected"; ?>>Bolívar</option>
										<option value="Carabobo" <?php if ($estadoPais === "Carabobo") echo "selected"; ?>>Carabobo</option>
										<option value="Cojedes" <?php if ($estadoPais === "Cojedes") echo "selected"; ?>>Cojedes</option>
										<option value="Delta Amacuro" <?php if ($estadoPais === "Delta Amacuro") echo "selected"; ?>>Delta Amacuro</option>
										<option value="Falcón" <?php if ($estadoPais === "Falcón") echo "selected"; ?>>Falcón</option>
										<option value="Guárico" <?php if ($estadoPais === "Guárico") echo "selected"; ?>>Guárico</option>
										<option value="Lara" <?php if ($estadoPais === "Lara") echo "selected"; ?>>Lara</option>
										<option value="Mérida" <?php if ($estadoPais === "Mérida") echo "selected"; ?>>Mérida</option>
										<option value="Miranda" <?php if ($estadoPais === "Miranda") echo "selected"; ?>>Miranda</option>
										<option value="Monagas" <?php if ($estadoPais === "Monagas") echo "selected"; ?>>Monagas</option>
										<option value="Nueva Esparta" <?php if ($estadoPais === "Nueva Esparta") echo "selected"; ?>>Nueva Esparta</option>
										<option value="Portuguesa" <?php if ($estadoPais === "Portuguesa") echo "selected"; ?>>Portuguesa</option>
										<option value="Sucre" <?php if ($estadoPais === "Sucre") echo "selected"; ?>>Sucre</option>
										<option value="Táchira" <?php if ($estadoPais === "Táchira") echo "selected"; ?>>Táchira</option>
										<option value="Trujillo" <?php if ($estadoPais === "Trujillo") echo "selected"; ?>>Trujillo</option>
										<option value="Vargas" <?php if ($estadoPais === "Vargas") echo "selected"; ?>>Vargas</option>
										<option value="Yaracuy" <?php if ($estadoPais === "Yaracuy") echo "selected"; ?>>Yaracuy</option>
										<option value="Zulia" <?php if ($estadoPais === "Zulia") echo "selected"; ?>>Zulia</option>
										<option value="Distrito Capital" <?php if ($estadoPais === "DISTRITO CAPITAL") echo "selected"; ?>>Distrito Capital</option>
									</select>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3"><label>Usuario:</label></div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="usuario" required="required" placeholder="Nombre de Usuario" value="<?php echo $usuario; ?>" oninput="this.value = this.value.toUpperCase()">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Edad</label></div>
								<div class="col-md-9">
									<input type="number" class="form-control" name="edad" required="required" placeholder="Edad" oninput="javascript: if (this.value.length > 2) this.value = this.value.slice(0, 2);" value="<?php echo $edad; ?>">
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Sexo</label></div>
								<div class="col-md-9">
									<select class="form-control" name="sexo">
										<option value="">Seleccione un Sexo</option>
										<option value="Masculino" <?php if ($sexo === "Masculino") echo "selected"; ?>>Masculino</option>
										<option value="Femenino" <?php if ($sexo === "Femenino") echo "selected"; ?>>Femenino</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3"><label>Pais</label></div>
								<div class="col-md-9">
									<input type="text" class="form-control" name="pais" required="required" placeholder="Pais" value="<?php echo $pais; ?>" oninput="this.value = this.value.toUpperCase()">
								</div>
							</div>
							<!-- Resto de los campos de edición -->
						</div>
					</div>
					<div id="res_edit_user"></div>
					<div class="modal-footer">
						<button type="submit" onclick="validateForm()">Guardar Cambios</button>
					</div>
				</form>
			</div>
		</div>

</header><!--/ fin del header-->