<?php include ('../admin/conexion.php');?>
<?php 
$suscriptor=$_POST['suscriptor'];
$fechaMensaje =date("Y-m-d h:i:s");

$sql="insert into suscriptores(correo,fecha_suscripcion)
values ('".$suscriptor."', '".$fechaMensaje."')";

$res=mysqli_query($con,$sql);
if($res){ 
	echo '<script> alert("Has quedado suscrito a nuestra biblioteca");</script>';
    echo '<script> window.location="../index.php"; </script>';
	}else {
		echo '<script> alert("Lo sentimos no pudimos suscribirte. Intentalo mas Tarde");</script>';
		echo '<script> window.location="../index.php"; </script>';

		}
?>