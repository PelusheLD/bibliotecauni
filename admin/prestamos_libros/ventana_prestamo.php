<?php
session_start();
include("../conexion.php");
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
        <link rel="shortcut icon" href="../../images/iconoLibreria.jpg">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/sb-admin.css" rel="stylesheet">
        <link href="../css/morris.css" rel="stylesheet">
        <link href="admin_productos/css/estilo.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="../js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>
        <script src="..7comentarios/Mis_funciones.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/bootstrap.js"></script>
        <script src="visitas/visitas.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <style>
            #estudiantes-table {
                display: none;
                /* Oculta la tabla al cargar la página */
            }
        </style>

        <script>
            // Función para buscar estudiantes
            function buscarEstudiantes() {
                var input, filter, table, tr, tdNombre, tdCarnet, i, txtValueNombre, txtValueCarnet;
                var select = document.getElementById("tipo-usuario");
                var estudiantesTable = document.getElementById("estudiantes-table");
                var profesoresTable = document.getElementById("profesores-table");

                input = document.getElementById("buscador");
                filter = input.value.toUpperCase();

                if (filter === "") {
                    estudiantesTable.style.display = "none";
                    profesoresTable.style.display = "none";
                    return;
                }

                if (select.value === "estudiante") {
                    estudiantesTable.style.display = "block";
                    profesoresTable.style.display = "none";
                    table = estudiantesTable;
                } else if (select.value === "profesor") {
                    estudiantesTable.style.display = "none";
                    profesoresTable.style.display = "block";
                    table = profesoresTable;
                }

                tr = table.getElementsByTagName("tr");

                var count = 0; // variable para contar los resultados mostrados
                for (i = 0; i < tr.length; i++) {
                    tdNombre = tr[i].getElementsByTagName("td")[0];
                    tdCarnet = tr[i].getElementsByTagName("td")[1];
                    if (tdNombre && tdCarnet) {
                        txtValueNombre = tdNombre.textContent || tdNombre.innerText;
                        txtValueCarnet = tdCarnet.textContent || tdCarnet.innerText;
                        if (
                            txtValueNombre.toUpperCase().indexOf(filter) > -1 ||
                            txtValueCarnet.toUpperCase().indexOf(filter) > -1
                        ) {
                            tr[i].style.display = "";
                            count++; // incrementar el contador de resultados mostrados
                            if (count > 3) {
                                tr[i].style.display = "none"; // ocultar los resultados después del tercer resultado
                            }
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            function seleccionarEstudiante(id, nombre) {
                document.getElementById("estudiante-id").value = id;
                document.getElementById("estudiante-nombre").value = nombre;
            }

            function cambiarAction() {
                var select = document.getElementById("tipo-usuario");
                var form = document.getElementById("prestamo-form");

                if (select.value === "estudiante") {
                    form.action = "recibir_prestamo_estudiante.php";
                } else if (select.value === "profesor") {
                    form.action = "recibir_prestamo_profesor.php";
                }
            }

            function enviarFormulario() {
                var form = document.getElementById("prestamo-form");
                form.submit();
            }
            window.addEventListener("DOMContentLoaded", function() {
                var form = document.getElementById("prestamo-form");
                form.action = "recibir_prestamo_estudiante.php";
            });
        </script>
    </head>

    <body>
        <?php include('../navegacion.php'); ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            <small><img src="../images/logo.png"></small>Proceso de Prestamo
                        </h2>
                    </div>
                </div>
                <!-- /.row -->
                <div class='row'>
                    <?php include "../conexion.php" ?>
                    <?php
                    $id = $_GET['id'];

                    $consulta3 = "select id_usuario_estudiante, nombre, carnet from usuario_estudiante";
                    $estudiante = mysqli_query($con, $consulta3);

                    ?>

                    <form class="form-group" method="post" id="prestamo-form" enctype="multipart/form-data">
                        <div class="modal-body">
                            <table border="0" width="50%">

                                <tr>
                                    <td colspan="2"><input type="text" class="form-control" required readonly id="id-prod" name="id-prod" readonly="readonly" style="visibility:hidden; height:5px;" /></td>
                                </tr>
                                <input name="id" type="hidden" value="<?php echo $id ?>" />
                                <tr>
                                    <td>Fecha de Entrega:</td>
                                    <td><input type="date" class="form-control" required name="fecha1" value="<?php echo date('Y-m-d'); ?>" readonly /></td>
                                </tr>
                                <tr>
                                    <td>Fecha de Devolución:</td>
                                    <td><input type="date" class="form-control" required name="fecha2" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+5 days')); ?>" /></td>
                                </tr>
                                <tr>
                                    <td>Tipo de usuario:</td>
                                    <td>
                                        <select class="form-control" id="tipo-usuario" onchange="cambiarAction()">
                                            <option value="estudiante">Estudiante</option>
                                            <option value="profesor">Profesor</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Estudiante:</td>
                                    <td>
                                        <input type="text" class="form-control" id="buscador" onkeyup="buscarEstudiantes()" placeholder="Buscar estudiante...">
                                        <table id="estudiantes-table" class="table table-striped">
                                            <?php
                                            while ($fila = mysqli_fetch_row($estudiante)) {
                                                echo "<tr onclick='seleccionarEstudiante(" . $fila[0] . ", \"" . $fila[1] . "\")'>";
                                                echo "<td>" . $fila[1] . "</td>";
                                                echo "<td>" . $fila[2] . "</td>"; // Agregamos el carnet en una nueva celda
                                                echo "</tr>";
                                            }
                                            ?>
                                        </table>
                                        <!-- Agrega esta tabla de profesores después de la tabla de estudiantes -->
                                        <table id="profesores-table" class="table table-striped" style="display: none;">
                                            <?php
                                            $consulta4 = "select id_usuario_profesor, nombre, carnet from usuario_profesores";
                                            $profesor = mysqli_query($con, $consulta4);

                                            while ($fila = mysqli_fetch_row($profesor)) {
                                                echo "<tr onclick='seleccionarEstudiante(" . $fila[0] . ", \"" . $fila[1] . "\")'>";
                                                echo "<td>" . $fila[1] . "</td>";
                                                echo "<td>" . $fila[2] . "</td>"; // Agregamos el DNI en una nueva celda
                                                echo "</tr>";
                                            }
                                            ?>
                                        </table>
                                        <input type="hidden" id="estudiante-id" name="estudiante" />
                                        <input type="text" class="form-control" id="estudiante-nombre" readonly />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                        <input type="button" value="Guardar" class="btn btn-success" onclick="enviarFormulario()" />
                                        <a href="../prestar_libro.php"> <input type="button" value="Cancelar" class="btn btn-danger" id="reg" /></a>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </form>
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