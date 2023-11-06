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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="js/jquery.js"></script>

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
          <small><img src="images/logo1.jpeg" width=180px height=90px></small> Copia de Seguridad
        </h1>
        <!-- /.row -->
        <section>
          <?php
          include 'conexion.php';
          ?>
          <div class="row">
            <form action="backup/Backup.php" method="post">
              <!--Fin del Segundo Row !-->
              <div class="col-md-4">
                <center>
                  <img src="images/db2.png">
                  <input type="submit" name="copia" value="Realizar Copia de Seguridad" class="btn btn-success">
                </center>
            </form>
          </div>
          <div class="col-md-6">

            <h2>Listado de Copias de Seguridad</h2>
            <?php
            $listar = null;
            $directorio = opendir("backup/backup/");
            while ($elemento = readdir($directorio)) {
              if ($elemento != '.' && $elemento != '..') {
                if (is_dir("backup/backup.$elemento")) {
                  $listar .= "<li><a href='backup/backup/$elemento' target='_blank'>$elemento</a></li>";
                } else {
                  $listar .= "<li><a href='backup/backup/$elemento' target='_blank'>$elemento</a></li>";
                }
              }
            }
            ?>
            <ul>
              <?php echo $listar ?>
            </ul>
          </div>
          <!-- Fin del Panel -->
      </div>
    </div>
    </div>
    </div>
    </section>

    <div class="registros" style="width:100%;" id="agrega-registros"></div>
    <center>
      <ul class="pagination" id="pagination"></ul>
    </center>

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