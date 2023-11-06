 <?php
	include('../conexion.php');

	function EncontrarReg($id)
	{
		$consulta = "select * from libros where id_libro=$id";
		$res = mysql_query($consulta);
		$fila = mysql_fetch_array($res);
		return $fila;
	}
	?> 
 
 <?php
	function grabarCambios($id, $foto, $nombre, $cota, $ejemplares, $descripcion, $disponible, $categoria, $proveedor, $fecha, $descarga)
	{
		if (isset($id)) {
			$cad = "update libros set foto='$foto',
		nombre='$nombre',
		cota='$cota',
		ejemplares='$ejemplares',
		descripcion='$descripcion',
		disponible='$disponible',
		categoria='$categoria', 
		proveedor='$proveedor',
		fecha='$fecha',
		descarga='$descarga' where id_libro=$id
		";
			mysql_query($cad) or die("Error al Actualizar");
			echo '<p>Registro Actualizado!</p>';
		}
	}
	?>
 <?php
	function borrar($id)
	{
		$cad = "DELETE from libros where id_libro=$id";
		mysql_query($cad) or die("Error al Borrar");
		echo 'Registro Eliminado';
	}
	?>