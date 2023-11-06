<?php
include_once("clase_categoria.php");
$objcategoria=new clase_categoria;

$cate=$_POST['cate'];
$subcate=$_POST['subcate'];
	if ($objcategoria->agregarCategoria($cate, $subcate)==true)
	{
		$mensaje="Registro grabado correctamente";
	   echo '<script> window.location="../admin/categorias.php"; </script>';
	}else{
		$mensaje="Error de grabacion";
	}
?>