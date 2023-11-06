<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso | Biblioteca</title>
    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="shortcut icon" href="../images/iconolibreria.jpg">

</head>

<body>
    <!-- Ventana Principal -->
    <div class="top-content">
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong></strong> Acceso Restringido</h1>
                        <div class="description">
                            <p>
                                Solo para el Administrador.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Centro de Control | Biblioteca Online</h3>
                                <img src="../images/logoBiblioteca.jpg" width="100px" height="100px">
                            </div>
                        </div>
                        <div class="form-bottom">
                            <form role="form" action="validar.php" method="post" class="login-form">
                                <div class="form-group">
                                    <label class="sr-only" for="form-username">Usuario</label>
                                    <input type="text" name="username" placeholder="Usuario" class="form-username form-control" id="form-username" required>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-password">Contraseña</label>
                                    <input type="password" name="password" placeholder="Contraseña" class="form-password form-control" id="form-password" required>
                                </div>
                                <button type="submit" class="btn" name="login">Entrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 social-login">
                        <div class="social-login-buttons">
                            <a class="btn btn-link-1 btn-link-1-google-plus" href="../inicio.php">
                                <i class="fa fa-close"></i> Salir
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if (isset($_SESSION['exito'])) {
            $respuesta = $_SESSION['exito']; ?>
            <script>
                Swal.fire(
                    'Exelente!',
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


    </div>
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>