<?php
include 'Connet.php';
$restorePoint=$_POST['restorePoint'];
$sql=explode(";",file_get_contents($restorePoint));
$totalErrors=0;
for($i = 0; $i < (count($sql)-1); $i++){
    if(SGBD::sql("$sql[$i];")){  }else{ $totalErrors++; }
}
if($totalErrors<=0){
	 echo '<script> alert("Restauracion de la Base de Datos Realizada con Exito.");</script>';
       echo '<script> window.location="../copiaSeguridad.php"; </script>';
}else{
	 echo '<script> alert("No se ha podido realizar la restauracion de la Base de Datos.");</script>';
       echo '<script> window.location="../copiaSeguridad.php"; </script>';
}