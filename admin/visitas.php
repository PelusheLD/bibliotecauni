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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="admin_productos/css/estilo.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="comentarios/Mis_funciones.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="visitas/visitas.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    </head>

    <body>
        <?php include('navegacion.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            <small><img src="images/logo1.jpeg" width=180px height=90px></small>Visitas a la Biblioteca
                        </h2>
                    </div>
                </div>
                <!-- /.row -->
                <div class='row'> <!-- /.Inicia el primer row -->
                    <table border="0" align="left">
                        <tr>
                            <td width="50"> </td>
                            <td style="margin-rigth:20px;" width="150"><B> Buscar Visita: </B></td>
                            <td><input type="text" style="border-radius:10px; padding-left:5px; heigth:25px;" placeholder="Buscar visita" id="bs-prod" /></td>
                            <td> &nbsp;</td>
                            <td></td>
                            <td> &nbsp;</td>
                            <td> </td>

                            <td> <a target="_blank" href="visitas/vaciarVisitas.php" class="btn btn-danger">Eliminar todas las Visitas</a></td>
                        </tr>
                    </table>
                    <br>
                    <br>
                    <div class="registros" id="agrega-registros_visitas"></div>
                    <center>
                        <ul class="pagination" id="pagination_visitas"></ul>
                    </center>
                </div> <!-- /. fin de row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- jQuery -->
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
?>