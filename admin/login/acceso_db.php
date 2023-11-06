 <?php
    $dbhost = "localhost"; // Host de la BD
    $dbusername = "root"; // Usuario de la BD
    $dbuserpass = ""; // Contraseña de la BD
    $dbname = "bibliotecauni"; // Nombre de la BD

    //conectamos y seleccionamos db
    mysql_connect($dbhost, $dbusername, $dbuserpass);
    mysql_select_db($dbname);
    ?> 