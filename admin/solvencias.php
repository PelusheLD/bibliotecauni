<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) {
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script>
            $(document).ready(function() {
                // Capturar el evento de búsqueda
                $('#bs-prod').on('keyup', function() {
                    var searchText = $(this).val().toLowerCase(); // Obtener el texto de búsqueda en minúsculas
                    var tipoBusqueda = $('[name="tipoBusqueda"]').val(); // Obtener el tipo de búsqueda seleccionado

                    // Realizar la petición AJAX al servidor
                    $.ajax({
                        url: 'buscar_solvencia.php', // Ruta al archivo PHP que realizará la búsqueda en el servidor
                        method: 'POST',
                        data: {
                            searchText: searchText,
                            tipoBusqueda: tipoBusqueda
                        }, // Enviar el texto de búsqueda al servidor
                        success: function(response) {
                            // Actualizar la tabla con los resultados filtrados
                            $('#agrega-registros').html(response);
                        }
                    });
                });
            });
        </script>

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
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Solvencias
                </h1>
                <!-- /.row -->
                <section>
                    <table border="0" align="left">
                        <tr>
                            <td style="margin-right:20px;"><b>Buscar Estudiantes:</b></td>
                            <td>&nbsp;&nbsp;</td>
                            <td width="335"><input type="text" placeholder="Busca por Nombre" id="bs-prod" style="border-radius:10px; padding-left:5px; height:25px; width:90%" /></td>
                            <td>
                                <select name="tipoBusqueda" class='form-control'>
                                    <option value="Estudiantes">Estudiantes</option>
                                    <option value="Profesores">Profesores</option>
                                    <option value="Otro">Otro</option>

                                </select>
                            </td>
                        </tr>

                    </table>
                </section>
                <br>
                <br>
                <div class="registros" style="width:100%;" id="agrega-registros">

                </div>
                <center>
                    <ul class="pagination" id="pagination"></ul>
                </center>
                <!-- MODAL PARA EL REGISTRO DE PRODUCTOS-->
            </div>
        </div>
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
    echo '<script> window.location="../login/login.php"; </script>';
}
