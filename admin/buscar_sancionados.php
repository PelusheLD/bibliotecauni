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

        .hidden {
            display: none;
        }
    </style>
    <script>
        function guardarRegistro(idUsuario, tipoBusqueda) {
            var fechaFinSancion = $("input[name='fecha_fin_sancion[" + idUsuario + "]']").val();
            var status = $("select[name='status[" + idUsuario + "]']").val();
            var razonSancion = $("input[name='razon_sancion[" + idUsuario + "]']").val();

            if (status === "OK") {
                $("input[name='razon_sancion[" + idUsuario + "]']").val("").addClass("hidden");
            } else {
                $("input[name='razon_sancion[" + idUsuario + "]']").removeClass("hidden");
            }

            var url;
            if (tipoBusqueda === "Estudiantes") {
                url = "guardar_registro.php";
            } else if (tipoBusqueda === "Profesores") {
                url = "guardar_registro.php";
            }

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    idUsuario: idUsuario,
                    fechaFinSancion: fechaFinSancion,
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
            var razonSancionTextarea = $(this).closest("tr").find("input[name^='razon_sancion']");
            if (razonSancionTextarea.val() !== "") {
                razonSancionTextarea.prop("disabled", true);
            } else {
                razonSancionTextarea.prop("disabled", false);
            }
            var tabla = document.querySelector(".table");
            tabla.parentNode.insertBefore(mensajeElemento, tabla);
            setTimeout(function() {
                $(mensajeElemento).fadeOut("slow", function() {
                    $(this).remove();
                    location.reload();
                });
            }, 1000);
        }
        $(document).ready(function() {
            $("select[name^='status']").change(function() {
                var idUsuarioEstudiante = $(this).closest("tr").find("td[data-id]").data("id");
                var fechaFinSancionInput = $(this).closest("tr").find("input[name^='fecha_fin_sancion']");
                var razonSancionTextarea = $(this).closest("tr").find("input[name^='razon_sancion']");
                if ($(this).val() === "Sancionado") {
                    fechaFinSancionInput.prop("disabled", false);
                    razonSancionTextarea.prop("disabled", razonSancionTextarea.val() !== "");
                } else if ($(this).val() === "Vetado") {
                    fechaFinSancionInput.prop("disabled", true);
                    razonSancionTextarea.prop("disabled", razonSancionTextarea.val() !== "");
                } else if ($(this).val() === "OK") {
                    fechaFinSancionInput.prop("disabled", true);
                    razonSancionTextarea.prop("disabled", false);
                }
            });
            var currentDate = new Date().toISOString().split('T')[0];
            fechaFinSancionInput.val(currentDate);
        });
    </script>

    <body>
        <div class="registros" style="width:100%;" id="agrega-registros">
            <table class="table table-striped table-condensed table-hover table-responsive">
                <tr>
                    <th width="50">Carnet</th>
                    <th width="100">Estudiante</th>
                    <th width="100">Apellidos</th>
                    <th width="100">Email</th>
                    <th width="50">Año</th>
                    <th width="100">Carrera</th>
                    <th width="50">Fecha Fin Sanción</th>
                    <th width="130">Status</th>
                    <th width="230">Razon de sansion</th>
                    <th width="20">identificador</th>
                    <th width="100">Accion</th>
                </tr>

                <?php
                if (isset($_POST['searchText']) && isset($_POST['tipoBusqueda'])) {
                    $searchText = $_POST['searchText'];
                    $tipoBusqueda = $_POST['tipoBusqueda'];

                    // Ajustar la consulta SQL según el tipo de búsqueda seleccionado
                    if ($tipoBusqueda === 'Estudiantes') {
                        $query = "SELECT * FROM usuario_estudiante WHERE nombre LIKE ? OR carnet LIKE ?";
                        $idColumn = 'id_usuario_estudiante';
                    } elseif ($tipoBusqueda === 'Profesores') {
                        $query = "SELECT * FROM usuario_profesores WHERE nombre LIKE ? OR carnet LIKE ?";
                        $idColumn = 'id_usuario_profesor';
                    }
                    $stmt = mysqli_prepare($con, $query);
                    $searchPattern = "%{$searchText}%";
                    mysqli_stmt_bind_param($stmt, "ss", $searchPattern, $searchPattern);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
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
                        $fechaFinSancion = $row['fecha_fin_sancion'];
                        $status = $row['status'];
                        $razonSancion = $row['razon_sancion'];
                        if ($status == 'Sancionado' && $fechaFinSancion < date('Y-m-d')) {
                            $updateQuery = "UPDATE usuario_estudiante SET status = 'OK' WHERE id_usuario_estudiante = {$row['id_usuario_estudiante']}";
                            mysqli_query($con, $updateQuery);
                            $status = 'OK';
                        }
                        if ($status == 'Sancionado' && $fechaFinSancion < date('Y-m-d')) {
                            if ($tipoBusqueda === 'Estudiantes') {
                                $updateQuery = "UPDATE usuario_estudiante SET status = 'OK' WHERE id_usuario_estudiante = {$row['id_usuario_estudiante']}";
                            } elseif ($tipoBusqueda === 'Profesores') {
                                $updateQuery = "UPDATE usuario_profesores SET status = 'OK' WHERE id_usuario_profesor = {$row['id_usuario_profesor']}";
                            }
                            mysqli_query($con, $updateQuery);
                            $status = 'OK';
                        }
                        echo "<tr>";
                        echo "<td>" . $row['carnet'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['apellidos'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['anio'] . "</td>";
                        echo "<td>" . $row['carrera'] . "</td>";
                        echo "<td><input type='date' name='fecha_fin_sancion[{$row[$idColumn]}]' value='{$fechaFinSancion}' class='form-control' " . (($status == 'Vetado') ? 'disabled' : '') . "></td>";
                        echo "<td><select name='status[{$row[$idColumn]}]' class='form-control'>";
                        if ($status == 'OK') {
                            echo "<option value='OK' selected>OK</option>";
                            echo "<option value='Sancionado'>Sancionado</option>";
                            echo "<option value='Vetado'>Vetado</option>";
                        } elseif ($status == 'Sancionado') {
                            echo "<option value='OK' disabled>OK</option>";
                            echo "<option value='Sancionado' selected>Sancionado</option>";
                            echo "<option value='Vetado'>Vetado</option>";
                        } elseif ($status == 'Vetado') {
                            echo "<option value='OK' disabled>OK</option>";
                            echo "<option value='Sancionado' disabled>Sancionado</option>";
                            echo "<option value='Vetado' selected>Vetado</option>";
                        }
                        echo "</select></td>";
                        echo "<td><input type='text' name='razon_sancion[{$row[$idColumn]}]' value='{$razonSancion}' class='form-control' " . (!empty($razonSancion) ? 'disabled' : '') . "></td>";
                        echo "<td data-id='{$row[$idColumn]}'><div class='identificador-circle' style='background-color: " . obtenerColorStatus($status) . "'></div></td>";
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
