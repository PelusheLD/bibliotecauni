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
    var url = "estudiantes/busca_estudiante.php";
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
function validarCarnet() {
  var carnet = document.getElementById("carnet").value;

  if (!/^\d{1,8}$/.test(carnet)) {
    alert("El carnet debe ser un número de hasta 8 dígitos.");
    return false;
  }

  return true;
}

function agregaEmpleado() {
  var url = "estudiantes/agrega_estudiante.php";
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
  var url = "estudiantes/elimina_estudiante.php";
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
  var url = "estudiantes/edita_estudiante.php";
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
      $("#carnet").val(datos[0]);
      $("#nombre").val(datos[1]);
      $("#apellidos").val(datos[2]);
      $("#email").val(datos[3]);
      $("#anio").val(datos[4]);
      $("#carrera").val(datos[5]);
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
  var url = "estudiantes/paginar_estudiante.php";
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
function validateForm() {
  // Obtener los valores de los campos
  var nombre = document.getElementsByName("nombre")[0].value;
  var cedula = document.getElementsByName("carnet")[0].value;
  var email = document.getElementsByName("email")[0].value;
  var prefijo = document.getElementsByName("prefijo")[0].value;
  var telefono = document.getElementsByName("telefono")[0].value;
  var direccion = document.getElementsByName("direccion")[0].value;
  var provincia = document.getElementsByName("provincia")[0].value;
  var estado = document.getElementsByName("estado")[0].value;
  var alias = document.getElementsByName("alias")[0].value;
  var pass = document.getElementsByName("pass")[0].value;
  var edad = document.getElementsByName("edad")[0].value;
  var sexo = document.getElementsByName("sexo")[0].value;
  var pais = document.getElementsByName("pais")[0].value;

  // Validar los campos

  if (nombre === "") {
    document.getElementsByName("nombre")[0].style.borderColor = "red";
    Swal.fire("Debes introducir un Nombre");
    return false;
  }
  var nameRegex = /[A-Z\s]+/;
  if (!nameRegex.test(nombre)) {
    document.getElementsByName("nombre")[0].style.borderColor = "red";
    Swal.fire("Por favor ingrese un nombre válido");
    return false;
  }
  if (cedula === "") {
    document.getElementsByName("cédula")[0].style.borderColor = "red";
    Swal.fire("Debes introducir una cedula!");
    return false;
  }
  return true;
}
