<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) { ?>
    <?php
    $consulta = "select id_subcategoria, nombre_subcategoria from subcategorias";
    $resultado = mysqli_query($con, $consulta);
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Biblioteca | Panel Administracion</title>
        <link rel="shortcut icon" href="../images/iconoLibreria.jpg">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/estilo.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="visitantes/myjava.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    </head>

    <body>
        <?php include('navegacion.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <br>
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                    </div>
                </div>
                <h1 class="page-header">
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Visitantes
                </h1>
                <!-- /.row -->
                <section>
                    <table border="0" align="left">
                        <tr>
                            <td style="margin-rigth:20px;"><B> Buscar visitante: </B></td>
                            <td>&nbsp; &nbsp;</td>
                            <td width="335"><input type="text" placeholder="Busca por Nombre" id="bs-prod" style="border-radius:10px; padding-left:5px; heigth:25px; width:90%" /></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="100"><button id="nuevo-producto" class="btn btn-success">Nuevo Visitante</button></td>
                            <td>&nbsp; &nbsp;</td>
                            <td width="200"></td>
                        </tr>
                    </table>
                </section>
                <br>
                <br>
                <div class="registros" style="width:100%;" id="agrega-registros"></div>
                <center>
                    <ul class="pagination" id="pagination"></ul>
                </center>
                <!-- MODAL PARA EL REGISTRO DE SUSCRIPTORES-->
                <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background:#839ca9;">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" style="color:white;" id="myModalLabel"><b>Visitantes</b></h4>
                            </div>
                            <form id="formulario" class="form-group" onsubmit="return agregaEmpleado();">
                                <div class="modal-body">
                                    <table border="0" width="100%">
                                        <tr>
                                            <td colspan="2"><input type="text" class="form-control" required readonly id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;" /></td>
                                        </tr>
                                        <tr>
                                            <td width="150">Proceso: </td>
                                            <td><input type="text" class="form-control" required readonly id="pro" name="pro" hidden="true" /></td>
                                        </tr>
                                        <div class="row">
                                            <div class="col-md-3"><label>Nombre:</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="nombre" id="nombre" required="required" placeholder="Nombre Completo" pattern="[A-Z\s]+" value="" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-3"><label>Cedula:</label></div>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="cédula" id="cédula" required="required" placeholder="Cedula" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, 8);">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Email:</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" id="email" required="required" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Por favor ingrese una dirección de correo electrónico válida" value="" oninput="this.value.toLowerCase()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Teléfono:</label>
                                            </div>
                                            <div class="col-md-5" style="display: flex;">
                                                <select class="form-control" name="prefijoo" id="prefijoo" required="required" style="width: 150px; margin-right: 10px;">
                                                    <option value="">Seleccione</option>
                                                    <option value="0412">0412</option>
                                                    <option value="0416">0416</option>
                                                    <option value="0426">0426</option>
                                                    <option value="0414">0414</option>
                                                    <option value="0424">0424</option>
                                                </select>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="number" class="form-control" name="telefono" id="telefono" required="required" placeholder="Teléfono" style="width: 250px;" oninput="javascript: if (this.value.length > 7) this.value = this.value.slice(0, 7);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Direccion:</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="direccion" id="direccion" required="required" placeholder="Direccion" value="" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Ciudad:</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="provincia" id="provincia" required="required" placeholder="Ciudad" value="" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Estado:</label></div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="estado" id="estado" required>
                                                    <option value="">Seleccione un estado</option>
                                                    <option value="Amazonas">Amazonas</option>
                                                    <option value="Anzoátegui">Anzoátegui</option>
                                                    <option value="Apure">Apure</option>
                                                    <option value="Aragua">Aragua</option>
                                                    <option value="Barinas">Barinas</option>
                                                    <option value="Bolívar">Bolívar</option>
                                                    <option value="Carabobo">Carabobo</option>
                                                    <option value="Cojedes">Cojedes</option>
                                                    <option value="Delta Amacuro">Delta Amacuro</option>
                                                    <option value="Falcón">Falcón</option>
                                                    <option value="Guárico">Guárico</option>
                                                    <option value="Lara">Lara</option>
                                                    <option value="Mérida">Mérida</option>
                                                    <option value="Miranda">Miranda</option>
                                                    <option value="Monagas">Monagas</option>
                                                    <option value="Nueva Esparta">Nueva Esparta</option>
                                                    <option value="Portuguesa">Portuguesa</option>
                                                    <option value="Sucre">Sucre</option>
                                                    <option value="Táchira">Táchira</option>
                                                    <option value="Trujillo">Trujillo</option>
                                                    <option value="Vargas">Vargas</option>
                                                    <option value="Yaracuy">Yaracuy</option>
                                                    <option value="Zulia">Zulia</option>
                                                    <option value="Distrito Capital">Distrito Capital</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Usuario:</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="usuario" id="usuario" required="required" placeholder="Nombre de Usuario" value="" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Contraseña:</label></div>
                                            <div class="col-md-9" style="position: relative;">
                                                <input type="password" class="form-control" name="pass" id="pass" required="required" placeholder="Contraseña" value="" pattern="^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}">
                                                <span id="mostrarContrasena" onclick="mostrarContrasena()" style="position: absolute; right: 5%; top: 50%; transform: translateY(-50%);">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <script>
                                            function mostrarContrasena() {
                                                var inputContrasena = document.getElementById("pass");
                                                var iconoOjo = document.getElementById("mostrarContrasena");

                                                if (inputContrasena.type === "password") {
                                                    inputContrasena.type = "text";
                                                    iconoOjo.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
                                                } else {
                                                    inputContrasena.type = "password";
                                                    iconoOjo.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
                                                }
                                            }
                                        </script>

                                        <div class="row">
                                            <div class="col-md-3"><label>Edad</label></div>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" name="edad" id="edad" required="required" placeholder="Edad" oninput="javascript: if (this.value.length > 2) this.value = this.value.slice(0, 2);">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Sexo</label></div>
                                            <div class="col-md-9">
                                                <select class="form-control" name="sexo" id="sexo">

                                                    <option value="">Seleccione un Sexo</option>
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><label>Pais</label></div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="pais" id="pais" required="required" placeholder="Pais" value="" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                        </div>
                                    </table>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" value="Registrar" class="btn btn-success" id="reg" />
                                    <input type="submit" value="Editar" class="btn btn-warning" id="edi" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var nombre = document.getElementById("nombre");
            nombre.addEventListener("input", function() {
                if (nombre.value === "") {
                    nombre.setCustomValidity("Debe introducir un nombre");
                    nombre.style.borderColor = "red";
                } else {
                    nombre.setCustomValidity("");
                    nombre.style.borderColor = "green";
                }
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(nombre.value)) {
                    nombre.setCustomValidity("El nombre solo debe contener letras.");
                    nombre.style.borderColor = "red";
                } else {
                    nombre.setCustomValidity("");
                    nombre.style.borderColor = "green";
                }
            });

            var carnet = document.getElementById("cédula");
            carnet.addEventListener("input", function() {
                if (carnet.value === "") {
                    carnet.setCustomValidity("Debe introducir una cedula valida");
                    carnet.style.borderColor = "red";
                } else {
                    carnet.setCustomValidity("");
                    carnet.style.borderColor = "green";
                }
                if (carnet.value < 1) {
                    carnet.setCustomValidity("No se permite un numero menor a 1");
                    carnet.style.borderColor = "red";
                } else {
                    carnet.setCustomValidity("");
                    carnet.style.borderColor = "green";
                }
            });
            var email = document.getElementById("email");
            email.addEventListener("input", function() {
                if (email.value === "") {
                    email.setCustomValidity("Debe introducir un email");
                    email.style.borderColor = "red";
                } else {
                    email.setCustomValidity("");
                    email.style.borderColor = "green";
                }

                var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!regex.test(email.value)) {
                    email.setCustomValidity("El formato del email no es válido.");
                    email.style.borderColor = "red";
                } else {
                    email.setCustomValidity("");
                    email.style.borderColor = "green";
                }
            });
            var telefono = document.getElementById("telefono");
            telefono.addEventListener("input", function() {
                if (telefono.value === "") {
                    telefono.setCustomValidity("Debe introducir telefono ");
                    telefono.style.borderColor = "red";
                } else {
                    telefono.setCustomValidity("");
                    telefono.style.borderColor = "green";
                }
                if (telefono.value < 0000001) {
                    telefono.setCustomValidity("introduce un numero valido");
                    telefono.style.borderColor = "red";
                } else {
                    telefono.setCustomValidity("");
                    telefono.style.borderColor = "green";
                }
            });
            var direccion = document.getElementById("direccion");
            direccion.addEventListener("input", function() {
                if (direccion.value === "") {
                    direccion.setCustomValidity("Debe introducir una direccion");
                    direccion.style.borderColor = "red";
                } else {
                    direccion.setCustomValidity("");
                    direccion.style.borderColor = "green";
                }
            });
            var ciudad = document.getElementById("provincia");
            ciudad.addEventListener("input", function() {
                if (ciudad.value === "") {
                    ciudad.setCustomValidity("Debe introducir una Ciudad");
                    ciudad.style.borderColor = "red";
                } else {
                    ciudad.setCustomValidity("");
                    ciudad.style.borderColor = "green";
                }
            });
            var usuario = document.getElementById("usuario");
            usuario.addEventListener("input", function() {
                if (usuario.value === "") {
                    usuario.setCustomValidity("Debe introducir un usuario");
                    usuario.style.borderColor = "red";
                } else {
                    usuario.setCustomValidity("");
                    usuario.style.borderColor = "green";
                }
            });
            var contraseña = document.getElementById("pass");
            contraseña.addEventListener("input", function() {
                if (contraseña.value === "") {
                    contraseña.setCustomValidity("Debe introducir un contraseña");
                    contraseña.style.borderColor = "red";
                } else {
                    contraseña.setCustomValidity("");
                    contraseña.style.borderColor = "green";
                }
                var contra = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                if (!contra.test(contraseña.value)) {
                    contraseña.setCustomValidity("El formato de la contraseña no es válido. Minimo 8 caracteres , 1 caracter especial , 1 mayuscula , 1 numero");
                    contraseña.style.borderColor = "red";
                } else {
                    contraseña.setCustomValidity("");
                    contraseña.style.borderColor = "green";
                }
            });
            var edad = document.getElementById("edad");
            edad.addEventListener("input", function() {
                if (edad.value === "") {
                    edad.setCustomValidity("Debe introducir una edad valida");
                    edad.style.borderColor = "red";
                } else {
                    edad.setCustomValidity("");
                    edad.style.borderColor = "green";
                }
                if (edad.value < 9) {
                    edad.setCustomValidity("No se permite un numero menor a 94");
                    edad.style.borderColor = "red";
                } else {
                    edad.setCustomValidity("");
                    edad.style.borderColor = "green";
                }
            });
            var pais = document.getElementById("pais");
            pais.addEventListener("input", function() {
                if (pais.value === "") {
                    pais.setCustomValidity("Debe introducir una pais");
                    pais.style.borderColor = "red";
                } else {
                    pais.setCustomValidity("");
                    pais.style.borderColor = "green";
                }
            });
        </script>
        </div>
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Morris Charts JavaScript -->
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>

    </body>
    </div>

    </html>
<?php
} else {
    echo '<script> window.location="../login/login.php"; </script>';
}
?>