<?php

session_start();
if (!isset($_SESSION['usuario'])) {
    // Redirigir a la página de inicio de sesión
    echo '<script> window.location="index.php"; </script>';
    exit;
}
include 'admin/conexion.php';
$token = rand(100000, 999999);

$usuario = $_SESSION['usuario'];
$nombreCompleto = $_SESSION['nombreCompleto'];
$email = $_SESSION['email'];
$cedula = $_SESSION['cedula'];

$changetoken = mysqli_query($con, "UPDATE visitantes SET token = $token WHERE usuario = '$usuario'");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "luispalacios123451@gmail.com";
    $mail->Password = "anjeeqjiyjcoqcbv";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("luispalacios123451@gmail.com", "Autenticacion de Inicio");
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Prueba de verificacion';
    $mail->Body = "Tu codigo para inicair sesion es el siguiente: $token";
    $mail->send();

    $_SESSION['exito'] = "Se a enviado un codigo de confirmacion a tu correco electronico, por favor verifica y utilizalo a continuacion para iniciar sesion";
} catch (Exception $e) {
    echo 'Mensaje' . $mail->ErrorInfo;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="login/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginassets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="login/assets/css/style.css">
    <link rel="shortcut icon" href="images/iconolibreria.jpg">
    <link rel="stylesheet" href="login/assets/css/estilologin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link href="css/verificacion.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 35%;
            padding: 10px;
        }

        .card {
            background-color: #fff;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.4);
        }

        .card-title {
            margin: 0;
            text-align: center;
            font-size: 26px;
            font-weight: 500;
        }

        .card-text {
            margin-top: 10px;
            text-align: center;
            font-size: 16px;
            color: #554;
        }

        .verification-input-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .verification-input {
            width: 55px;
            height: 20px;
            text-align: center;
            margin: 0 3px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid rgba(6, 127, 255, 0.5);
        }

        .verification-input:hover {
            border-color: rgba(6, 127, 255, 0.5);
        }

        .verification-input:focus {
            border-color: rgba(6, 127, 255, 0.5);
        }

        .btn {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h3 class="card-title">Código de Autenticación</h3>
            <p class="card-text">Por favor, ingrese el código de verificación que se le fue enviado al correo electrónico.</p>
            <form action="validando.php" method="post">
                <div class="verification-input-container">
                    <input type="text" class="verification-input" maxlength="1" required autofocus name="uno" id="uno" onkeyup="moveToNextInput(event, 'dos')">
                    <input type="text" class="verification-input" maxlength="1" required name="dos" id="dos" onkeyup="moveToNextInput(event, 'tres')">
                    <input type="text" class="verification-input" maxlength="1" required name="tres" id="tres" onkeyup="moveToNextInput(event, 'cuatro')">
                    <input type="text" class="verification-input" maxlength="1" required name="cuatro" id="cuatro" onkeyup="moveToNextInput(event, 'cinco')">
                    <input type="text" class="verification-input" maxlength="1" required name="cinco" id="cinco" onkeyup="moveToNextInput(event, 'seis')">
                    <input type="text" class="verification-input" maxlength="1" required name="seis" id="seis">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
            </form>

        </div>
        <div style="margin-top: 40px;">
            <form action="login/logout2.php" method="post">
                <input type="submit" class="btn" value="Salir">
            </form>
        </div>
    </div>

    <script>
        function moveToNextInput(event, nextInputId) {
            const input = event.target;
            if (input.value.length === input.maxLength) {
                document.getElementById(nextInputId).focus();
            }
        }
    </script>
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
</body>


</html>