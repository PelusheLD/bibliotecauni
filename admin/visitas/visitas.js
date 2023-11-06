$(document).ready(pagination(1));
$(function(){
	$('#fdesde').on('change', function(){
		var desde = $('#fdesde').val();
		var hasta = $('#fhasta').val();
		var url = 'visitas/buscar_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros-visitas').html(datos);
		}
	});
	return false;

	});
		$('#fhasta').on('change', function(){
		var desde = $('#fdesde').val();
		var hasta = $('#fhasta').val();
		var url = 'visitas/buscar_fecha.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros-visitas').html(datos);
		}
	});
	return false;
	});
	


	$('#bs-prod').on('keyup',function(){
		var dato = $('#bs-prod').val();
		var url = 'visitas/busca_visita.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros_visitas').html(datos);
		}
	});
	return false;
	});
	
});

function eliminarComentario(id){
	var url = 'visitas/elimina_visita.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Producto?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros_visitas').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function eliminarTodas(){
	var url = 'visitas/vaciarVisitas.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Producto?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros_visitas').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}


function pagination(partida){
	var url = 'visitas/paginar_visita.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros_visitas').html(array[0]);
			$('#pagination_visitas').html(array[1]);
		}
	});
	return false;
}