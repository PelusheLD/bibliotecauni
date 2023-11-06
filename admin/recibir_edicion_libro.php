<?php
include('conexion.php');
$id = $_POST['id_oculto'];
$cota = $_POST['cota'];
$nombre = $_POST['nombre'];
$ejemplares = $_POST['ejemplares'];
$descripcion = $_POST['descripcion'];
$disponible = $_POST['disponible'];
$categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];
$proveedor = $_POST['proveedor'];
$descarga = $_POST['descarga'];
$fecha = date("Y-m-d");

//$rutaEnServidor='images';
//$rutaTemporal=$_FILES['foto']['tmp_name'];
//$nombreImagen=$_FILES['foto']['name'];

//$imagen=$rutaEnServidor."/".$nombreImagen;

//move_uploaded_file($rutaTemporal,"/".$rutaEnServidor."/".$nombreImagen);

$rutaservidor = 'images/';
$rutatemporal = $_FILES['foto']['tmp_name'];
$nombrefoto = $_FILES['foto']['name'];
//$tipo = $_FILES['foto']['type'];
$rutadestino = $rutaservidor . '/' . $nombrefoto;
move_uploaded_file($rutatemporal, $rutadestino);

$actualizar = mysqli_query($con, "update libros set foto='$rutadestino',
cota='$cota',
		nombre='$nombre',
		ejemplares='$ejemplares',
		descripcion='$descripcion',
		disponible='$disponible',
		id_categoria='$categoria',
		id_subcategoria'$subcategoria',
		id_proveedor='$proveedor',
		fecha_ingreso='$fecha',
		url_descarga='$descarga'
		where id_libro=$id");
if ($actualizar) {
	echo '<script> alert("Modificacion Exitosa.");</script>';
	echo '<script> window.location="Lista_libros.php"; </script>';
} else {
	echo '<script> alert("Fallo al realizar la actualizacion.");</script>';
	echo '<script> window.location="Lista_libros.php"; </script>';
}
