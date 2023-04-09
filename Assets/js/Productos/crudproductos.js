function productonuevo() {
    $("#txtnombre").val("");
    $("#txtdescripcion").val("");
    $("#txtprecio").val("");
    $("#txtstock").val("");
  $("#modalfrmProducto").modal("show");
}

function categorianuevo() {
  $("#txtcategoria").val("");
  $("#modalfrmCategoria").modal("show");
}

function insertarProductos() {
  var nombreProducto = $("#txtnombre").val();
  var descripcion = $("#txtdescripcion").val();
  var precio = $("#txtprecio").val();
  var stock = $("#txtstock").val();
  var categoria = $("#categoria").val();
  

  $.ajax({
    url: "../../controlador/insertProductos.php",
    type: "post",
    data: {
      "nombreProducto": nombreProducto,
      "descripcion": descripcion,
      "precio": precio,
      "stock": stock,
      "categoria": categoria,
    },
    success: function (data) {
      console.log(data);
      if (data == "ok") {
        listarProductos();
        $("#modalfrmProducto").modal("hide");
      } else {
        alert("Error al insertar los datos");
      }
    },
  });
}
function listarProductos() {
  $.ajax({
    url: "../../controlador/listarProductos.php",
    type: "post",
    data: {},
    success: function (data) {
      console.log(data);
      $("#registroProductos").html(data);
    },
  });
}

function editarProductos(id) {
  $.ajax({
    url: "../../controlador/editarProductos.php",
    type: "post",
    data: { id: id },
    success: function (data) {
      console.log(data);
      var datos = JSON.parse(data);
      $("#idproducto").val(datos.id_Producto);
      $("#txtnombre").val(datos.nombreProducto);
      $("#txtdescripcion").val(datos.descripcion);
      $("#txtprecio").val(datos.precio);
      $("#txtstock").val(datos.stock);
      $("#categoria").val(datos.id_Categoria);
      $("#modalfrmProducto").modal("show");
    },
  });
}

function actualizarProductos() {
  var idProducto = $("#idproducto").val();
  var nombreProducto = $("#txtnombre").val();
  var descripcion = $("#txtdescripcion").val();
  var precio = $("#txtprecio").val();
  var stock = $("#txtstock").val();
  var categoria = $("#categoria").val();

  $.ajax({
    url: "../../controlador/actualizarProductos.php",
    type: "post",
    data: {
      "idProducto": idProducto,
      "nombreProducto": nombreProducto,
      "descripcion": descripcion,
      "precio": precio,
      "stock": stock,
      "categoria": categoria,
    },
    success: function (data) {
      console.log(data);
      if (data == "ok") {
        listarProductos();
        $("#modalfrmProducto").modal("hide");
      } else {
        alert("Error al actualizar los datos");
      }
    },
  });
}
function eliminarProductos(id) {
  $.ajax({
    url: "../../controlador/eliminarProductos.php",
    type: "post",
    data: { id: id },
    success: function (data) {
      console.log(data);
      if (data == "ok") {
        listarProductos();
      } else {
        alert("Error al eliminar los datos");
      }
    },
  });
}

function guardarProductos() {
  var idProducto = $("#idproducto").val();
  if (idProducto > 0) {
    actualizarProductos();
  } else {
    insertarProductos();
  }
  
}


