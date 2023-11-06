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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sb-admin.css" rel="stylesheet">
        <link href="css/morris.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <script src="js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <script src="comentarios/Mis_funciones.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>

    <body>
        <?php include('navegacion.php'); ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                            <small><img src="images/logo1.jpeg" width=180px height=90px></small> Listado de Prestamos a Estudiantes
                        </h2>
                    </div>
                </div>
                <!-- /.row -->
                <div class='row'>
                    <div align="center">
                        <section style="text-align: center;">
                            <form method="post" action="">
                                <label for="estado"><b>Mostrar resultados:</b></label>
                                <div class="form-group" style="display: inline-block;">
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="1">Prestados</option>
                                        <option value="0">Devueltos</option>
                                    </select>
                                </div>
                                <label for="carnet"><b>Buscar por Cedula:</b></label>
                                <div class="form-group" style="display: inline-block;">
                                    <input type="text" name="carnet" id="carnet" class="form-control" placeholder="Ingrese el Cedula">
                                </div>
                                <input type="submit" value="Mostrar" class="btn btn-primary">
                            </form>
                        </section>

                        <?php
                        $estadoSeleccionado = isset($_POST['estado']) ? $_POST['estado'] : null;
                        $carnetBuscado = isset($_POST['carnet']) ? $_POST['carnet'] : null;

                        // Consulta SQL para obtener el número total de registros
                        $query_total = "SELECT COUNT(*) AS total FROM prestamo_libro";
                        $resultado_total = mysqli_query($con, $query_total) or die(mysqli_error($con));
                        $fila_total = mysqli_fetch_assoc($resultado_total);
                        $total_registros = $fila_total['total'];

                        // Calcular el número total de páginas
                        $registros_por_pagina = 10;
                        $total_paginas = ceil($total_registros / $registros_por_pagina);

                        // Obtener el número de página actual
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
                        $inicio = ($pagina_actual - 1) * $registros_por_pagina;

                        // Consulta SQL con LIMIT y OFFSET para la paginación
                        $query = "SELECT prestamo_libro.id_prestamo AS prestamo, libros.disponible AS disponible, prestamo_libro.fecha_prestamo AS fecha1, prestamo_libro.fecha_entrega AS fecha2, 
                libros.nombre AS nombre, usuario_estudiante.nombre AS estudiante, usuario_estudiante.carnet AS carnet,
                prestamo_libro.estado AS estado
                FROM prestamo_libro
                INNER JOIN libros ON prestamo_libro.id_libro = libros.id_libro
                INNER JOIN usuario_estudiante ON prestamo_libro.id_usuario_estudiante = usuario_estudiante.id_usuario_estudiante";

                        if ($estadoSeleccionado !== null || $carnetBuscado !== null) {
                            $query .= " WHERE";

                            if ($estadoSeleccionado !== null) {
                                $query .= " prestamo_libro.estado = $estadoSeleccionado";
                            }

                            if ($estadoSeleccionado !== null && $carnetBuscado !== null) {
                                $query .= " AND";
                            }

                            if ($carnetBuscado !== null) {
                                $query .= " usuario_estudiante.carnet LIKE '%$carnetBuscado%'";
                            }
                        }

                        $query .= " ORDER BY prestamo_libro.estado DESC LIMIT $inicio, $registros_por_pagina";

                        $registro = mysqli_query($con, $query) or die(mysqli_error($con));





                        echo '<table width="900" class="table table-striped table-condensed table-hover">
                    <tr>
                        <th></th>
                        <th>Prestamo</th>
                        <th>Fecha Prestamo</th>
                        <th>Fecha Entrega</th>
                        <th>Libro</th>
                        <th>Estudiante</th>
                        <th>Cedula</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>';

                        if (mysqli_num_rows($registro) > 0) {
                            while ($registro2 = mysqli_fetch_assoc($registro)) {
                                $id = $registro2['prestamo'];
                                $estado = $registro2['estado'];
                                $disponible = $registro2['disponible'];

                                switch ($estado) {
                                    case 0:
                                        $diestado = "Prestado";
                                        break;
                                    case 1:
                                        $diestado = "Libre";
                                        break;
                                }

                                echo '<tr';
                                // Código para aplicar el color de fondo según el estado del libro
                                switch ($estado) {
                                    case 0:
                                        echo ' style="background:rgba(255, 99, 71, 0.8); color:white;"';
                                        break;
                                    case 1:
                                        echo ' style="background:rgba(0, 163, 0, 0.8); color:white;"';
                                        break;
                                }

                                echo '>
                                    <td> </td>
                                    <td>' . "E" . $registro2['prestamo'] . '</td>
                                    <td>' . $registro2['fecha1'] . '</td>
                                    <td>' . $registro2['fecha2'] . '</td>
                                    <td>' . $registro2['nombre'] . '</td>
                                    <td>' . $registro2['estudiante'] . '</td>
                                    <td>' . $registro2['carnet'] . '</td>
                                    <td>' . $registro2['estado'] . '</td>';

                                if ($estado == 1) {
                                    // Código para mostrar el diálogo modal con los campos de estado del libro y fecha actual
                                    echo '<td>
                                        <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#devolverModal-' . $registro2['prestamo'] . '">Devolver</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="devolverModal-' . $registro2['prestamo'] . '" tabindex="-1" role="dialog" aria-labelledby="devolverModalLabel-' . $registro2['prestamo'] . '">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="devolverModalLabel-' . $registro2['prestamo'] . '" style="color:black">Detalles de la entrega</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="prestamos_libros/devolver_libro.php?id=' . $registro2['prestamo'] . '"">
                                                            <div class="form-group">
                                                                <label for="estado-select-' . $registro2['prestamo'] . '"style="color:black">Libro en buen estado?:</label>
                                                                <select name="estado" id="estado-select-' . $registro2['prestamo'] . '" class="form-control">
                                                                    <option value="Bien">Bien</option>
                                                                    <option value="Dañado">Dañado</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fecha-input-' . $registro2['prestamo'] . '" style="color:black">Fecha de entrega:</label>
                                                                <input type="date" name="fecha_entregaa" id="fecha-input-' . $registro2['prestamo'] . '" class="form-control" value="' . date("Y-m-d") . '" readonly>
                                                            </div>
                                                            <input type="hidden" name="id_prestamo" value="' . $registro2['prestamo'] . '">
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td></td>
                                   </tr>';
                                }
                            }
                        } else {
                            '<tr><script>
    Swal.fire("No hay resultados que mostrar!")</script></tr>';
                        }

                        echo '</table>';
                        echo '<div class="text-center">
                                <ul class="pagination">';

                        if ($pagina_actual > 1) {
                            echo '<li><a href="?pagina=' . ($pagina_actual - 1) . '">Anterior</a></li>';
                        }

                        for ($i = 1; $i <= $total_paginas; $i++) {
                            if ($i == $pagina_actual) {
                                echo '<li class="active"><a href="#">' . $i . '</a></li>';
                            } else {
                                echo '<li><a href="?pagina=' . $i . '">' . $i . '</a></li>';
                            }
                        }

                        if ($pagina_actual < $total_paginas) {
                            echo '<li><a href="?pagina=' . ($pagina_actual + 1) . '">Siguiente</a></li>';
                        }

                        echo '</ul>
                            </div>';
                        ?>

                    </div>
                </div>
            </div>
        </div>
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
<?php } ?>