<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Biblioteca | Panel Administracion</title>
        <link rel="shortcut icon" href="../images/iconolibreria.jpg">
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
        <script src="estudiantes/myjava.js"></script>
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
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Estudiantes
                </h1>
                <!-- /.row -->
                <section>
                    <table border="0" align="left">
                        <tr>
                            <td style="margin-rigth:20px;"><B> Buscar Estudiante: </B></td>
                            <td>&nbsp; &nbsp;</td>
                            <td width="335"><input type="text" placeholder="Busca por Nombre" id="bs-prod" style="border-radius:10px; padding-left:5px; heigth:25px; width:90%" /></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="100"><button id="nuevo-producto" class="btn btn-success">Nuevo Estudiante</button></td>
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
                <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
                <div class="modal fade" id="registra-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background:#839ca9;">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" style="color:white;" id="myModalLabel"><b>Estudiantes del Sistema</b></h4>
                            </div>
                            <form id="formulario" class="form-group" onsubmit="return agregaEmpleado();">
                                <div class="modal-body">
                                    <table border="0" width="100%">
                                        <tr>
                                            <td colspan="2"><input type="text" class="form-control" required readonly id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;" /></td>
                                        </tr>
                                        <tr>
                                            <td width="150">Proceso: </td>
                                            <td><input type="text" class="form-control" required readonly id="pro" name="pro" /></td>
                                        </tr>
                                        <tr>
                                            <td>Carnet: </td>
                                            <td><input type="number" class="form-control" required name="carnet" id="carnet" maxlength="100" oninput="javascript: if (this.value.length > 8) this.value = this.value.slice(0, 8);"></td>
                                        </tr>
                                        <tr>
                                            <td>Nombre:</td>
                                            <td><input type="text" class="form-control" required name="nombre" id="nombre" maxlength="100" oninput="this.value = this.value.toUpperCase()"></td>
                                        </tr>
                                        <tr>
                                            <td>Apellidos:</td>
                                            <td><input type="text" class="form-control" required name="apellidos" id="apellidos" maxlength="100" oninput="this.value = this.value.toUpperCase()"></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td><input type="text" class="form-control" required name="email" id="email" maxlength="100" oninput="this.value.toLowerCase()" /></td>
                                        </tr>
                                        <tr>
                                            <td>Año:</td>
                                            <td>
                                                <select name="anio" id="anio" class="form-control" requerid>
                                                    <option selected>1ro.</option>
                                                    <option>2do.</option>
                                                    <option>3ro.</option>
                                                    <option>4to.</option>
                                                    <option>5to.</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Carrera:</td>
                                            <td>
                                                <select name="carrera" id="carrera" class="form-control" requerid>
                                                    <option selected>Ingenieria de Sistemas</option>
                                                    <option>Ingenieria Civil</option>
                                                    <option>Ingenieria Agroindustrial</option>
                                                </select>
                                            </td>
                                        </tr>
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
            var carnet = document.getElementById("carnet");
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
            var apellidos = document.getElementById("apellidos");
            apellidos.addEventListener("input", function() {
                if (apellidos.value === "") {
                    apellidos.setCustomValidity("Debe introducir un apellido");
                    apellidos.style.borderColor = "red";
                } else {
                    apellidos.setCustomValidity("");
                    apellidos.style.borderColor = "green";
                }
                var regex = /^[a-zA-Z\s]+$/;
                if (!regex.test(apellidos.value)) {
                    apellidos.setCustomValidity("El apellido solo debe contener letras.");
                    apellidos.style.borderColor = "red";
                } else {
                    apellidos.setCustomValidity("");
                    apellidos.style.borderColor = "green";
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

    </html>
<?php
} else {
    echo '<script> window.location="../login/login.php"; </scrip>';
}
?>