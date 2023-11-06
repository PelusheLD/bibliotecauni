$(document).ready(pagination(1));
$(function () {
  $("#bd-desde").on("change", function () {
    var desde = $("#bd-desde").val();
    var hasta = $("#bd-hasta").val();
    var url = "clientes/busca_producto_fecha.php";
    $.ajax({
      type: "POST",
      url: url,
      data: "desde=" + desde + "&hasta=" + hasta,
      success: function (datos) {
        $("#agrega-registros").html(datos);
      },
    });
    return false;
  });

  $("#nuevo-producto").on("click", function () {
    $("#formulario")[0].reset();
    $("#pro").val("Registro");
    $("#edi").hide();
    $("#reg").show();
    $("#registra-producto").modal({
      show: true,
      backdrop: "static",
    });
  });

  $("#bs-prod").on("keyup", function () {
    var dato = $("#bs-prod").val();
    var url = "usuarios/busca_usuario.php";
    $.ajax({
      type: "POST",
      url: url,
      data: "dato=" + dato,
      success: function (datos) {
        $("#agrega-registros").html(datos);
      },
    });
    return false;
  });
});

function agregaEmpleado() {
  var url = "usuarios/agrega_usuario.php";
  $.ajax({
    type: "POST",
    url: url,
    data: $("#formulario").serialize(),
    success: function (registro) {
      if ($("#pro").val() == "Registro") {
        $("#formulario")[0].reset();
        $("#mensaje")
          .addClass("bien")
          .html("Registro completado con exito")
          .show(200)
          .delay(2500)
          .hide(200);
        $("#agrega-registros").html(registro);
        return false;
      } else {
        $("#mensaje")
          .addClass("bien")
          .html("Edicion completada con exito")
          .show(200)
          .delay(2500)
          .hide(200);
        $("#agrega-registros").html(registro);
        return false;
      }
    },
  });
  return false;
}

function eliminarEmpleado(id) {
  var url = "usuarios/elimina_usuario.php";
  Swal.fire({
    title: "Estas Seguro?",
    text: "Esta opcion no es reversible!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: url,
        data: "id=" + id,
        success: function (registro) {
          $("#agrega-registros").html(registro);
          Swal.fire("Eliminado!", "Se a eliminado correctamente.", "success");
        },
        error: function (xhr, textStatus, error) {
          Swal.fire("Error", "No se a podido borrar. Error: " + error, "error");
        },
      });
    }
  });
}

function editarEmpleado(id) {
  $("#formulario")[0].reset();
  var url = "usuarios/edita_usuario.php";
  $.ajax({
    type: "POST",
    url: url,
    data: "id=" + id,
    success: function (valores) {
      var datos = eval(valores);
      $("#reg").hide();
      $("#edi").show();
      $("#pro").val("Edicion");
      $("#id-prod").val(id);
      $("#user").val(datos[0]);
      $("#pass").val(datos[1]);
      $("#registra-producto").modal({
        show: true,
        backdrop: "static",
      });
      return false;
    },
  });
  return false;
}

function pagination(partida) {
  var url = "usuarios/paginar_usuario.php";
  $.ajax({
    type: "POST",
    url: url,
    data: "partida=" + partida,
    success: function (data) {
      var array = eval(data);
      $("#agrega-registros").html(array[0]);
      $("#pagination").html(array[1]);
    },
  });
  return false;
}
