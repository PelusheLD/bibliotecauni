<?php include('../conexion.php'); ?>
<?php
$rutaservidor = 'images';
$rutatemporal = $_FILES['imagen']['tmp_name'];
$nombreimagen = $_FILES['imagen']['name'];
$rutadestino = $rutaservidor . '/' . $nombreimagen;
move_uploaded_file($rutatemporal, '../' . $rutadestino);

$nombre = $_POST['nombre'];
$cota = $_POST['cota'];
$ejemplares = $_POST['ejemplares'];
$descripcion = $_POST['descripcion'];
$disponible = $_POST['disponible'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$proveedor = $_POST['proveedor'];
$descarga = $_POST['descarga'];
$fecha = date("Y-m-d");

$sql = "insert into libros(foto,nombre,cota,ejemplares,descripcion,disponible,id_categoria,id_subcategoria,id_proveedor,fecha_ingreso,url_descarga)
values ('" . $rutadestino . "',
'" . $nombre . "',
'" . $cota . "',
'" . $ejemplares . "',
'" . $descripcion . "',
'" . $disponible . "',
'" . $categoria . "',
'" . $subcategoria . "',
'" . $proveedor . "',
'" . $fecha . "',
'" . $descarga . "')";

$res = mysql_query($sql, $conexion);
if ($res) {
	echo '<script> alert("Se ha agregado el libro satisfactoriamente.");</script>';
} else {
	echo '<script> alert("Error al guardar el nuevo libro.");</script>';
}
?>
<html>

<head>
	<meta http-equiv="refresh" content="1; url=../Lista_libros.php">
</head>

</html>