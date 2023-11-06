<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <script>
            $(document).ready(function() {
                $('#bs-prod').on('change', function() {
                    var categoria = $(this).val();
                    if (categoria) {
                        $.ajax({
                            type: 'POST',
                            url: "prestamos_libros/busca_prestamo.php", // Cambia esto a la ruta de tu archivo PHP
                            data: {
                                categoria: categoria
                            },
                            success: function(data) {
                                // Actualiza tus registros con los nuevos resultados
                                $('#agrega-registros').html(data);
                            }
                        });
                    }
                });
            });
        </script>
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
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/estilo.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="prestamos_libros/myjava.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>

    <body>
        <?php include('navegacion.php'); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <br>
                <h1 class="page-header">
                    <small><img src="images/logo1.jpeg" width=180px height=90px></small> Prestamos de Libros
                </h1>

                <table border="0" align="center">
                    <tr>
                        <td><b>Buscar Libros:</b></td>
                        <td>&nbsp; &nbsp;</td>
                        <td width="335">
                            <select id="bs-prod" style="border-radius: 10px; padding-left: 5px; height: 25px; width: 90%">
                                <option value="">Todas las categorías</option>
                                <?php
                                include('../conexion.php');
                                $query = "SELECT * FROM categorias";
                                $result = mysqli_query($con, $query) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['nombre_categoria'] . '">' . $row['nombre_categoria'] . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td width="116"></td>
                        <td>&nbsp;</td>
                        <td width="100"></td>
                    </tr>
                </table>
                <br>
                <div class="registros" style="width:100%;" id="agrega-registros"></div>
                <center>
                    <ul class="pagination" id="pagination"></ul>
                </center>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
        <?php
        if (isset($_SESSION['exito'])) {
            $respuesta = $_SESSION['exito']; ?>
            <script>
                Swal.fire(
                    'Excelente!',
                    '<?php echo $respuesta; ?>',
                    'success'
                )
            </script>
        <?php
            unset($_SESSION['exito']);
        }
        ?>
        <?php
        if (isset($_SESSION['wr'])) {
            $respuesta = $_SESSION['wr']; ?>
            <script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: '<?php echo $respuesta; ?>',
                })
            </script>
        <?php
            unset($_SESSION['wr']);
        }
        ?>
        <?php
        if (isset($_SESSION['error'])) {
            $respuesta = $_SESSION['error']; ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo $respuesta; ?>',
                })
            </script>
        <?php
            unset($_SESSION['error']);
        }
        ?>
    </body>

    </html>
<?php
} else {
    echo '<script> window.location="../login/login.php"; </script>';
}
?>