
<?php include ('admin/conexion.php');

$peticion = "INSERT INTO visitas VALUES (
'".date('U')."',
'".date('Y-m-d h:i:s')."',
'".$_SERVER['REMOTE_ADDR']."',
'".$_SERVER['HTTP_USER_AGENT']."',
'".$_SERVER['REQUEST_URI']."'
)";
$resultado = mysqli_query($con, $peticion);
$con->close();
?>

