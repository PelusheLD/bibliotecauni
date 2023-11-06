<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Código</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="login/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="loginassets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="login/assets/css/style.css">
    <link rel="shortcut icon" href="images/iconolibreria.jpg">
    <link rel="stylesheet" href="login/assets/css/estilologin.css">
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
            <form action="#" method="post">
                <div class="verification-input-container">
                    <input type="text" class="verification-input" maxlength="1" required autofocus name="uno" id="uno">
                    <input type="text" class="verification-input" maxlength="1" required name="dos" id="dos">
                    <input type="text" class="verification-input" maxlength="1" required name="tres" id="tres">
                    <input type="text" class="verification-input" maxlength="1" required name="cuatro" id="cuatro">
                    <input type="text" class="verification-input" maxlength="1" required name="cinco" id="cinco">
                    <input type="text" class="verification-input" maxlength="1" required name="seis" id="seis">
                    <input type="submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</body>

</html>