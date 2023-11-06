<?php
include('conexion.php');
$paginaActual = $_POST['partida'];

$nroProductos = mysqli_num_rows(mysqli_query($con, "SELECT pedidos.id, clientes.usuario, pedidos.fecha, pedidos.estado, lineaspedido.unidades, productos.nombre, productos.precio
FROM pedidos
INNER JOIN clientes ON pedidos.idcliente = clientes.id
INNER JOIN lineaspedido ON lineaspedido.idpedido = pedidos.id
INNER JOIN productos ON lineaspedido.idproducto = productos.id"));
$nroLotes = 2;
$nroPaginas = ceil($nroProductos / $nroLotes);
$lista = '';
$tabla = '';

if ($paginaActual > 1) {
  $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual - 1) . ');">Anterior</a></li>';
}
for ($i = 1; $i <= $nroPaginas; $i++) {
  if ($i == $paginaActual) {
    $lista = $lista . '<li class="active"><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
  } else {
    $lista = $lista . '<li><a href="javascript:pagination(' . $i . ');">' . $i . '</a></li>';
  }
}
if ($paginaActual < $nroPaginas) {
  $lista = $lista . '<li><a href="javascript:pagination(' . ($paginaActual + 1) . ');">Siguiente</a></li>';
}

if ($paginaActual <= 1) {
  $limit = 0;
} else {
  $limit = $nroLotes * ($paginaActual - 1);
}

$registro = mysqli_query($con, "SELECT pedidos.id, clientes.usuario, pedidos.fecha, pedidos.estado, lineaspedido.unidades, productos.nombre, productos.precio
FROM pedidos
INNER JOIN clientes ON pedidos.idcliente = clientes.id
INNER JOIN lineaspedido ON lineaspedido.idpedido = pedidos.id
INNER JOIN productos ON lineaspedido.idproducto = productos.id");


$tabla = $tabla . '<table class="table table-striped table-condensed table-hover">
			         <tr>
               <th width="60">Pedido</th>
              <th width="100">Cliente</th>
              <th width="120">Fecha Compra</th>
              <th width="70">Estado</th>
              <th width="70">Unidades</th>
              <th width="130">Producto</th>
              <th width="80">Precio</th>
              <th width="100">Pedido Total</th>
              <th width="60"></th>
              <th width="60"></th>
            </tr>';

if (mysqli_num_rows($registro) > 0) {
  while ($registro2 = mysqli_fetch_assoc($registro)) {
    //  $id=$registro2['id'];
    $estado = $registro2['estado'];
    $precio = $registro2['precio'];
    $unidades = $registro2['unidades'];

    $total = $precio * $unidades;
    switch ($estado) {
      case 0:
        $diestado = "no servido";
        break;
      case 1:
        $diestado = "servido";
        break;
      case 2:
        $diestado = "anulado";
        break;
    }
    echo '<tr';
    switch ($estado) {
      case 0:
        echo ' style="background:rgb(255,200,200);"';
        break;
      case 1:
        echo ' style="background:rgb(200,255,200);"';
        break;
      case 2:
        echo ' style="background:rgb(255,255,200);"';
        break;
    }
    echo '>
        <td>' . $registro2['id'] . '</td>
        <td>' . $registro2['usuario'] . '</td>
        <td>' . $registro2['fecha'] . '</td>
        <td>' . $registro2['estado'] . '</td>
            <td>' . $registro2['unidades'] . '</td>
        <td>' . $registro2['nombre'] . '</td>
        <td>' . $registro2['precio'] . '</td>
        <td>' . $total . ' C$</td>'

?>
        <?php
        if (($estado) == 0) {
          echo '
              <td><a href="ventas/pedidoservido.php?id=' . $registro2['id'] . '"><button class="btn btn-success btn-xs">Entregar y Cobrar</button></a></td>
              <td><a href="ventas/cancelarpedido.php?id=' . $registro2['id'] . '"><button class="btn btn-danger btn-xs">Cancelar Pedido</button></a></td>
        </tr>';
        }

        echo '
              <td></td>
              <td></td>
        </tr>';
      }
    }


    $tabla = $tabla . '</table>';



    $array = array(
      0 => $tabla,
      1 => $lista
    );

    echo json_encode($array);
        ?>