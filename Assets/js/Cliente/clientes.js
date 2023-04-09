function Clientefrm() {
    $("#txtdni").val("");
    $("#txtnombreNat").val("");
    $("#txtrucJ").val("");
    $("#txtnombreJ").val("");
    $("#txtDireccionJ").val("");
  $("#modalfrmCliente").modal("show");

}


function TipoCliente() { 
  var tipo = $("#tipoclienteprincipal").val();
  if (tipo==1) {
    $("#clienteNat").toggle(600);
    $("#ClienteJur").hide();
    
  }else if(tipo==2){
    $("#ClienteJur").toggle(600);
    $("#clienteNat").hide();
  } 
 
}
function formularioBoleta() { 
  var comprobante = $("#tipocomprobante").val();
  if (comprobante==0) {
    $("#frmboleta").hide();
    $("#frmfactura").hide();
  }
  if (comprobante == 1) {
    $("#frmboleta").toggle(600);
    $("#frmfactura").hide();
  } if(comprobante==2) {
    $("#frmfactura").toggle(600);
    $("#frmboleta").hide();

  } 
}

function esconderfrmboleta() { 
   $("#frmboleta").hide();
}
function esconderfrmfactura() {
  $("#frmfactura").hide();
}
function esconderdivCliN() {
  $("#CliN").hide();
}
function esconderdivCliJ() {
  $("#CliJ").hide();
}
function esconderregclientes() {
  $("#regClientes").hide();
}
function esconderCliN() {
  $("#clienteNat").hide();
}
function esconderCliJ() {
  $("#ClienteJur").hide();
}
function esconderregPro() {
  $("#regPro").hide();
}

 

function listarCliente() {
  $("#regClientes").toggle(600);
  var txtbusca = $("#txtbusca").val();
  $.ajax({
    url: "../../controlador/buscarcliente.php",
    type: "post",
    data: { txtbusca: txtbusca },
    success: function (data) {
      console.log(data);
      $("#registrosCliente").html(data);
    },
  });
}
function getCliente(id,tipo) {
  var dm = tipo;

  console.log(dm);
  if (tipo == 1) {
    $("#CliN").toggle(600);
    $("#CliJ").hide();
      $.ajax({
        url: "../../controlador/getClienteVenta.php",
        type: "post",
        data: { id: id },
        success: function (data) {
          console.log(data);
          var datos = JSON.parse(data);
          $("#dni").val(datos.dni);
          $("#nombreNatural").val(datos.nombre);
          $("#direccionNatural").val(datos.direccion);
          $("#CliN").html.data;
          $("#regClientes").hide();
          
        },
      });
  } else if (tipo == 2) {
    $("#CliJ").toggle(600);
    $("#CliN").hide();
    $.ajax({
      url: "../../controlador/getClienteVenta.php",
      type: "post",
      data: { id: id },
      success: function (data) {
        console.log(data);
        var datos = JSON.parse(data);
        $("#ruc").val(datos.ruc);
        $("#nombreCliente").val(datos.nombre);
        $("#direccionCliente").val(datos.direccion);
        $("#correoCliente").val(datos.correo);
        $("#CliJ").html.data;
        $("#regClientes").hide();
        
      },
    });
  }

}
function busquedaProductoVenta() {
  $("#regPro").toggle(600);
  var buscaProducto = $("#codigopro").val();
  //var idProducto = id;
  $.ajax({
    url: "../../controlador/listarProductoVenta.php",
    type: "post",
    data: {
      buscaProducto: buscaProducto,
    },
    success: function (data) {
      console.log(data);
      $("#registrosProductos").html(data);
    },
  });
}
function getProductoVenta(id) { 
  $.ajax({
    url: "../../controlador/editarProductos.php",
    type: "post",
    data: { id: id },
    success: function (data) {
      console.log(data);
      var datos = JSON.parse(data);
      $("#nombreProducto").val(datos.nombreProducto);
      $("#cantidad").focus();
      $("#precio").val(datos.precio);
      $("#getProVenta").html.data;
      esconderregPro();

    },
  });
}
function calcularVentaPro() { 
  var cant = $("#cantidad").val();
  var precio = $("#precio").val();
  var subTotal = $("#subTotal").val();
  var subTotal = 0;
  var subTotal = cant * precio;
  console.log(cant, precio);
  $("#subTotal").val(subTotal);
  
}
function registrarPro() { 
  var codigo = $("#codigopro").val();
  var nombre = $("#nombreProducto").val();
  var cantidad = $("#cantidad").val();
  var precio = $("#precio").val();
  var subTotal = $("#subTotal").val();

  $.ajax({
    url: "../../controlador/insertardetalleProductosV.php",
    type: "post",
    data: {
      codigo: codigo,
      nombre: nombre,
      cantidad: cantidad,
      precio: precio,
      subTotal: subTotal,
    },
    success: function (data) {
      console.log(data);
      if (data == "ok") {
        listarProductosPorVender();
      } else {
        alert("Error al insertar los datos");
      }
    },
  });
}
function listarProductosPorVender() { 
   $.ajax({
     url: "../../controlador/listarProductostemp.php",
     type: "post",
     data: {},
     success: function (data) {
       console.log(data);
       $("#registrosProductosPorVender").html(data);
       
     },
   });
}

function eliminarProductosTemp(iddem) {
  $.ajax({
    url: "../../controlador/eliminarDetalleProducto.php",
    type: "post",
    data: { "iddem": iddem },
    success: function (data) {
      console.log(data);
      if (data = "ok") {
        listarProductosPorVender();
        calcularVentaTotal();
      } else {
        alert("Error al eliminar los datos");
      }
    },
  });
}
function calcularVentaTotal() {
  $.ajax({
    url: "../../controlador/calcularVentaTotal.php",
    type: "post",
    data: { },
    success: function (data) {
      // var datos = JSON.parse(data);
      console.log(data);
      $("#Total").val(data);
      
    },
  });
}

function generarVenta() {
  
  
}


