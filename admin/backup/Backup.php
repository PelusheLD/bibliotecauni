<?php
include '../conexion.php';
$day=date("d");
$mont=date("m");
$year=date("Y");
$hora=date("H-i-s");
$fecha=$day.'_'.$mont.'_'.$year;
define("BD", "bibliotecauni");
define("BACKUP_PATH", "backup/");
$DataBASE="Backup_Biblioteca_".$fecha."_(".$hora."_hrs).sql";
$tables=array();
$error=0;
$result=mysqli_query($con, 'SHOW TABLES');
if($result){
    while($row=mysqli_fetch_row($result)){
        $tables[] = $row[0];
    }
    $sql='SET FOREIGN_KEY_CHECKS=0;'."\n\n";
    $sql.='CREATE DATABASE IF NOT EXISTS '.BD.";\n\n";
    $sql.='USE '.BD.";\n\n";
    foreach($tables as $table){
        $result=mysqli_query($con, 'SELECT * FROM '.$table);
        if($result){
            $numFields=mysqli_num_fields($result);
            $sql.='DROP TABLE IF EXISTS '.$table.';';
            $row2=mysqli_fetch_row(mysqli_query($con,'SHOW CREATE TABLE '.$table));
            $sql.="\n\n".$row2[1].";\n\n";
            for ($i=0; $i < $numFields; $i++){
                while($row=mysqli_fetch_row($result)){
                    $sql.='INSERT INTO '.$table.' VALUES(';
                    for($j=0; $j<$numFields; $j++){
                        $row[$j]=addslashes($row[$j]);
                        $row[$j]=str_replace("\n","\\n",$row[$j]);
                        if (isset($row[$j])){
                            $sql .= '"'.$row[$j].'"' ;
                        }
                        else{
                            $sql.= '""';
                        }
                        if ($j < ($numFields-1)){
                            $sql .= ',';
                        }
                    }
                    $sql.= ");\n";
                }
            }
            $sql.="\n\n\n";
        }else{
            $error=1;
        }
    }
    if($error==1){
        echo '<script> alert("Ocurrio un error.");</script>';
    }else{
        chmod(BACKUP_PATH, 0777);
        $sql.='SET FOREIGN_KEY_CHECKS=1;';
        $handle=fopen(BACKUP_PATH.$DataBASE,'w+');
        if(fwrite($handle, $sql)){
            fclose($handle);
            echo '<script> alert("Backup Realizado con Exito.");</script>';
       echo '<script> window.location="../copiaseguridad.php"; </script>';
        }else{
             echo '<script> alert("Ocurrio un error.");</script>';
        }
    }
}else{
    echo '<script> alert("Ocurrio un error.");</script>';
}
mysqli_free_result($result);