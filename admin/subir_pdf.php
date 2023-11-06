<?php
include_once 'pdf/config.inc.php';
if (isset($_POST['subir'])) {
    $nombre = $_FILES['archivo']['name'];
    $tipo = $_FILES['archivo']['type'];
    $tamanio = $_FILES['archivo']['size'];
    $ruta = $_FILES['archivo']['tmp_name'];
    $destino = "pdf/archivos/" . $nombre;
    if ($nombre != "") {
        if (copy($ruta, $destino)) {
            $libro = $_POST['libro'];
            $titulo = $_POST['titulo'];
            $descri = $_POST['descripcion'];
            $db = new Conect_MySql();
            $sql = "INSERT INTO pdf (id_libro, titulo,descripcion,tamanio,tipo,nombre_archivo) VALUES('$libro','$titulo','$descri','$tamanio','$tipo','$nombre')";
            $query = $db->execute($sql);
            if ($query) {
                echo '<script> alert("El Libro PDF se ha subido al servidor con Exito.");</script>';
                echo '<script> window.location="subir_pdf.php"; </script>';
            }
        } else {
            echo '<script> alert("Error al subir el Libro.");</script>';
        }
    }
}

?>
<?php
include_once 'pdf/config.inc.php';
$db = new Conect_MySql();
$consulta = "select id_libro, nombre from libros";
$resultado = $db->execute($consulta);

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
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="../images/iconoLibreria.jpg">

    <link href="libros/css/estilo.css" rel="stylesheet">
    <script src="libros/js/jquery.js"></script>
    <script src="clientes/myjava.js"></script>
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
                    <br>

                </div>

            </div>
            <h1 class="page-header2">
                <small><img src="images/logo1.jpeg" width=180px height=90px></small> Subir Libros PDF
            </h1>
            <!-- /.row -->
            <br>
            <form method="post" action="" enctype="multipart/form-data">
                <table width="70%">
                    <tr>
                        <td><label>Titulo</label></td>
                        <td><input type="text" name="titulo" class="form-control" required></td>
                    </tr>
                    <tr>
                        <td><label>Libro:</label></td>
                        <td>
                            <select name="libro" class="form-control">
                                <?php
                                if ($resultado->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
                                {
                                    while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='" . $row['id_libro'] . "'>" . $row['nombre'] . "</option>";
                                    }
                                } else {
                                    echo "No hubo resultados";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>Descripcion</label></td>
                        <td><textarea name="descripcion" class="form-control" required></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="file" name="archivo" class="form-control" required></td>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Subir Libro" name="subir" class="btn btn-success">
                            <a href="lista_pdf.php"><b style="color:#fff; padding:9px; background:#2329b1; border-radius:5px">Listado de Libros</b></a>

                        </td>
                    </tr>
                </table>
            </form>

            <!--fin del backup -->

            <!--fin de la restauracion -->
            <br>
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