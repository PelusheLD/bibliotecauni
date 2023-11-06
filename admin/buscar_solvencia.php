<?php
session_start();
include("conexion.php");
if (isset($_SESSION['user'])) {
?>
    <!DOCTYPE html>
    <html lang="en">
    <script src="js/jquery.js"></script>
    <style>
        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .identificador-circle {
            width: 33px;
            height: 33px;
            border-radius: 50%;
            margin: 0 auto;
        }
    </style>
    <script>
        function guardarRegistro(idUsuario, tipoBusqueda) {
            var status = $("select[name='status[" + idUsuario + "]']").val();
            var razonSancion = $("input[name='razon_sancion[" + idUsuario + "]']").val();
            $.ajax({
                url: "guardar_registro_solvencia.php",
                type: "POST",
                data: {
                    idUsuario: idUsuario,
                    status: status,
                    razonSancion: razonSancion,
                    tipoBusqueda: tipoBusqueda
                },
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    mostrarMensajeExitoso(jsonResponse.message);
                    var identificadorElemento = $("td[data-id='" + idUsuario + "'] .identificador-circle");
                    identificadorElemento.css("background-color", obtenerColorStatus(status));
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        function mostrarMensajeExitoso(message) {
            var mensajeElemento = document.createElement("div");
            mensajeElemento.className = "success-message";
            mensajeElemento.textContent = message;
            var tabla = document.querySelector(".table");
            tabla.parentNode.insertBefore(mensajeElemento, tabla);
            setTimeout(function() {
                $(mensajeElemento).fadeOut("slow", function() {
                    $(this).remove();
                });
            }, 3000);
        }

        function pagarSancion(idUsuarioEstudiante) {
            $("#status_" + idUsuarioEstudiante).val("OK");
            $("#razon_sancion_" + idUsuarioEstudiante).val("");
        }
    </script>

    <body>
        <div class="registros" style="width:100%;" id="agrega-registros">
            <table class="table table-striped table-condensed table-hover table-responsive">
                <tr>
                    <th width="50">Carnet</th>
                    <?php
                    $tipoBusqueda = $_POST['tipoBusqueda'];
                    if ($tipoBusqueda === 'Estudiantes') {
                        echo '<th width="100">Estudiante</th>';
                    } elseif ($tipoBusqueda === 'Profesores') {
                        echo '<th width="100">Profesor</th>';
                    } elseif ($tipoBusqueda === 'Nombre') {
                        echo '<th width="100">Profesor</th>';
                    }
                    ?>
                    <th width="100">Apellidos</th>
                    <th width="100">Email</th>
                    <th width="50">Año</th>
                    <th width="100">Carrera</th>
                    <th width="100">Status</th>
                    <th width="220">Razon de sansion</th>
                    <th width="100">identificador</th>
                    <th width="100">Solvencia</th>
                    <th width="100">Accion</th>
                </tr>

                <?php

                if (isset($_POST['searchText']) && isset($_POST['tipoBusqueda'])) {
                    $searchText = $_POST['searchText'];
                    $tipoBusqueda = $_POST['tipoBusqueda'];

                    // Ajustar la consulta SQL según el tipo de búsqueda seleccionado
                    if ($tipoBusqueda === 'Estudiantes') {
                        $query = "SELECT * FROM usuario_estudiante WHERE nombre LIKE '%$searchText%' OR carnet LIKE '%$searchText%'";
                        $idColumn = 'id_usuario_estudiante';
                    } elseif ($tipoBusqueda === 'Profesores') {
                        $query = "SELECT * FROM usuario_profesores WHERE nombre LIKE '%$searchText%' OR carnet LIKE '%$searchText%'";
                        $idColumn = 'id_usuario_profesor';
                    } elseif ($tipoBusqueda === 'Otro') {
                        $query = "SELECT * FROM usuario_otro WHERE nombre LIKE '%$searchText%' OR carnet LIKE '%$searchText%'";
                        $idColumn = 'id_usuario_otro';
                    }

                    $result = mysqli_query($con, $query);
                    function obtenerColorStatus($status)
                    {
                        switch ($status) {
                            case 'OK':
                                return 'green';
                            case 'Sancionado':
                                return 'orange';
                            case 'Vetado':
                                return 'red';
                            default:
                                return 'gray';
                        }
                    }
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['status'];
                        $razonSancion = $row['razon_sancion'];
                        echo "<tr>";
                        echo "<td>{$row['carnet']}</td>";
                        echo "<td>{$row['nombre']}</td>";
                        echo "<td>{$row['apellidos']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['anio']}</td>";
                        echo "<td>{$row['carrera']}</td>";
                        echo "<td>
            <select id='status_" . $row[$idColumn] . "' name='status[" . $row[$idColumn] . "]' class='form-control' disabled>
                <option value='OK' " . ($status == 'OK' ? 'selected' : '') . ">OK</option>
                <option value='Sancionado' " . ($status == 'Sancionado' ? 'selected' : '') . ">Sancionado</option>
                <option value='Vetado' " . ($status == 'Vetado' ? 'selected' : '') . ">Vetado</option>
            </select>
        </td>";
                        echo "<td><input id='razon_sancion_{$row[$idColumn]}' type='text' name='razon_sancion[{$row[$idColumn]}]' value='$razonSancion' class='form-control' disabled></td>";
                        echo "<td data-id='{$row[$idColumn]}'><div class='identificador-circle' style='background-color: " . obtenerColorStatus($status) . "'></div></td>";
                        echo "<td>";
                        if ($status == 'OK') {
                            echo "<button class='btn btn-success'>Solvente</button>";
                            echo "<button class='btn btn-danger' onclick='(" . ")' style='display: none;'>Pagar Sanción</button>";
                        } else {
                            echo "<button class='btn btn-success' style='display: none;'>Solvente</button>";
                            echo "<button class='btn btn-danger' onclick='pagarSancion(" . $row[$idColumn] . ")'>Pagar Sanción</button>";
                        }
                        echo "</td>";
                        $buttonStyle = ($status == 'OK') ? "style='display: none;'" : "";
                        echo "<td><button class='btn btn-primary' onclick='guardarRegistro({$row[$idColumn]}, \"{$tipoBusqueda}\")'>Guardar</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
        <center>
            <ul class="pagination" id="pagination"></ul>
        </center>
        </div>
        </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/morris/raphael.min.js"></script>
        <script src="js/plugins/morris/morris.min.js"></script>
        <script src="js/plugins/morris/morris-data.js"></script>
    </body>

    </html>

<?php
} else {
    echo '<script> window.location="../login/login.php"; </script>';
}
