<?php
include('../conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysqli_num_rows(mysqli_query($con, "SELECT * FROM comentarios"));
    $nroLotes = 8;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

    if($paginaActual > 1){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
    }
    for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
            $lista = $lista.'<li class="active"><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }else{
            $lista = $lista.'<li><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }
    }
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
    }
  
  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}
  	$registro = mysqli_query($con, "SELECT * FROM comentarios LIMIT $limit, $nroLotes ");
  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover table-responsive">
			            <tr>
              <th width="100"></th>
			        <th width="200">Remitente</th>
              <th width="200">Correo</th>
              <th width="400">Mensaje</th>
              <th width="200">Fecha Envio</th>
               <th width="50">Opciones</th>
			            </tr>';		
	while($registro2 = mysqli_fetch_array($registro)){
		$tabla = $tabla.'<tr>
        <td></td>
        <td>'.$registro2['remitente'].'</td>
        <td>'.$registro2['correo'].'</td>
        <td>'.$registro2['mensaje'].'</td>
        <td>'.$registro2['fecha'].'</td>
        <td> <a href="javascript:eliminarComentario('.$registro2['id_comentario'].');">
            <img src="../images/delete.png" width="15" height="15" alt="delete" title="Eliminar" /></a>
         </td>
        </tr>';		
	}
    $tabla = $tabla.'</table>';
    $array = array(0 => $tabla,
    			   1 => $lista);
    echo json_encode($array);
?>