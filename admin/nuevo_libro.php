<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) { ?>

    <?php
    $consulta1 = "select id_categoria, nombre_categoria from categorias";
    $categoria = mysql_query($consulta1);

    $consulta2 = "select id_proveedor, nombre_proveedor from proveedor";
    $proveedor = mysql_query($consulta2);

    $consulta3 = "select id_subcategoria, nombre_subcategoria from subcategorias";
    $subcategoria = mysql_query($consulta3);
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
        <link rel="shortcut icon" href="../images/iconolibreria.ico">
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
        <script src="libros/myjava.js"></script>
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
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Libros
                </h1>
                <!-- /Formulario -->

                <form action="libros_biblioteca/recibirlibros.php" method="post" enctype="multipart/form-data" name="form2" id="form2">
                    <table class="table table-bordered table-condensed table-responsive table-striped table-hover" width="79%" border="1">
                        <tr>
                            <td colspan="2" align="center">
                                <h3>Ingresar nuevo libro</h3>
                            </td>
                        </tr>
                        <tr>
                            <td width="87">Imagen</td>
                            <td width="271"><input type="file" class="form-control" name="imagen" id="imagen" required /></td>
                        </tr>
                        <tr>
                            <td>Nombre</td>
                            <td><input type="text" name="nombre" class="form-control" id="nombre" required /></td>
                        </tr>
                        <tr>
                            <td>Ejemplares</td>
                            <td><input type="text" name="ejemplares" class="form-control" id="ejemplares" required /></td>
                        </tr>
                        <tr>
                            <td>Descripcion</td>
                            <td><input type="text" name="descripcion" class="form-control" id="descripcion" required /></td>
                        </tr>
                        <tr>
                            <td>Disponible</td>
                            <td><input type="text" name="disponible" class="form-control" id="disponible" required /></td>
                        </tr>
                        <tr>
                            <td>Categoria:</td>
                            <td><select name="categoria" id="categoria" class="form-control" class="form-control" requerid>
                                    <?php
                                    while ($fila = mysql_fetch_row($categoria)) {
                                        echo "<option value='" . $fila['0'] . "'>" . $fila['1'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Subcategoria:</td>
                            <td><select name="subcategoria" id="subcategoria" class="form-control" requerid>
                                    <?php
                                    while ($fila = mysql_fetch_row($subcategoria)) {
                                        echo "<option value='" . $fila['0'] . "'>" . $fila['1'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Proveedor:</td>
                            <td><select name="proveedor" id="proveedor" class="form-control" requerid>
                                    <?php
                                    while ($fila2 = mysql_fetch_row($proveedor)) {
                                        echo "<option value='" . $fila2['0'] . "'>" . $fila2['1'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Fecha</td>
                            <td><input type="text" name="fecha" id="fecha" value="<?php echo date("Y-m-d"); ?>" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>URL Descarga</td>
                            <td><input type="text" name="descarga" id="descarga" class="form-control" required /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input class="btn btn-success btn-group-lg" type="submit" name="button" id="button" value="Enviar" />
                                <input class="btn btn-warning btn-group-lg" type="reset" name="nuevo" id="nuevo" value="Nuevo" />
                            </td>
                        </tr>
                    </table>
                </form>
                <!-- fin de la tabla -->
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