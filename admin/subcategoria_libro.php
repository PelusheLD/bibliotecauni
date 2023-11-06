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
        <script src="subcategoria_libro/myjava.js"></script>


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
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Subcategorias
                </h1>
                <!-- /.row -->
                <section>
                    <table border="0" align="left">
                        <tr>
                            <td style="margin-rigth:20px;"><B> Buscar Subcategoria: </B></td>
                            <td>&nbsp; &nbsp;</td>
                            <td width="335"><input type="text" placeholder="Busca por Nombre" id="bs-prod" style="border-radius:10px; padding-left:5px; heigth:25px; width:90%" /></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="100"><button id="nuevo-producto" class="btn btn-success">Nueva Subcategoria</button></td>
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
                                <h4 class="modal-title" style="color:white;" id="myModalLabel"><b>SubCategorias</b></h4>
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
                                            <td>Nombre Subcategoria: </td>
                                            <td><input type="text" class="form-control" required name="nombre" id="nombre" maxlength="100" oninput="this.value = this.value.toUpperCase();" /></td>
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
?>