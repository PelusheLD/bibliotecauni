<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-fw fa-user"></i> <?php //echo $user; 
                                                                                                                ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" target="contenedor"><i class="fa fa-fw fa-user"></i> Perfil</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="../login/logout.php"><i class="fa fa-fw fa-power-off"></i> Cerrar Sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">

            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="inicio.php"><i class="fa fa-fw fa-home"></i> Inicio</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#mantenimiento"><i class="fa fa-fw fa-book"></i> Libros<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="mantenimiento" class="collapse">

                        <li>
                            <a href="libros.php"><i class="fa fa-fw fa-book"></i> Libros</a>
                        </li>

                        <li>
                            <a href="categoria_libro.php"><i class="fa fa-fw fa-list-ol"></i> Categorias</a>
                        </li>
                        <li>
                            <a href="subcategoria_libro.php"><i class="fa fa-fw fa-bars"></i> Subcategorias</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#prestamo"><i class="fa fa-fw fa-book"></i> Prestamos<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="prestamo" class="collapse">
                        <li>
                            <a href="prestar_libro.php"><i class="fa fa-fw fa-share-alt"></i> Prestar Libro</a>
                        </li>
                        <li>
                            <a href="Lista_prestamos_libros.php"><i class="fa fa-fw fa-book"></i>Estudiantes</a>
                        </li>
                        <li>
                            <a href="Lista_prestamos_libross.php"><i class="fa fa-fw fa-book"></i>Profesores</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#pdf"><i class="fa fa-fw fa-file-pdf-o"></i> PDF<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="pdf" class="collapse">
                        <li>
                            <a href="lista_pdf.php"><i class="fa fa-fw fa-file-pdf-o"></i> PDF</a>
                        </li>
                        <li>
                            <a href="subir_pdf.php"><i class="fa fa-fw fa-arrow-circle-up"></i> Subir PDF</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="comentarios.php"><i class="fa fa-fw fa-envelope"></i> Mensajes</a>
                </li>
                <li>
                    <a href="suscriptores.php"><i class="fa fa-fw fa-check-square-o"></i> Suscriptores</a>
                </li>
                <li>
                    <a href="visitas.php"><i class="fa fa-fw fa-globe"></i> Visitas</a>
                </li>
                <li>
                    <a href="copiaSeguridad.php"><i class="fa fa-fw fa-database"></i> Respaldo</a>
                </li>
                <li>
                    <a href="usuarios.php"><i class="fa fa-fw fa-users"></i> Usuarios</a>
                </li>
                <li>
                    <a href="estudiantes.php"><i class="fa fa-fw fa-users"></i> Estudiantes</a>
                </li>
                <li>
                    <a href="profesores.php"><i class="fa fa-fw fa-users"></i> Profesores</a>
                </li>
                <li>
                    <a href="visitantes.php"><i class="fa fa-fw fa-users"></i> Visitantes</a>
                </li>
                <li>
                    <a href="sanciones.php"><i class="fa fa-fw fa-times"></i> Sanciones</a>
                </li>
                <li>
                    <a href="reportes.php"><i class="fa fa-fw fa-warning"></i> Reportes</a>
                </li>
                <li>
                    <a href="solvencias.php"><i class="fa fa-fw fa-file-o"></i> Solvencias</a>
                </li>
                <li>
                    <a href="../login/logout.php"><i class="fa fa-fw fa-power-off"></i> Cerrar sesion</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>