
let tableClientes;
let divLoading = document.querySelector("#divLoading");
document.addEventListener("DOMContentLoaded", function () {

    tableClientes = $("#datatblClientes").DataTable({
      select: true,
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
      },
      ajax: {
        url: "" + BASE_URL + "Clientes/getClientes",
        dataSrc: "",
      },
      columns: [
        { data: "id_usuario" },
        { data: "dni" },
        { data: "nombre" },
        { data: "apellidos" },
        { data: "correo" },
        { data: "telefono" },
        { data: "options" },
      ],
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='far fa-copy'></i> Copiar",
          titleAttr: "Copiar",
          className: "btn btn-secondary",
        },
        {
          extend: "excelHtml5",
          text: "<i class='fas fa-file-excel'></i> Excel",
          titleAttr: "Esportar a Excel",
          className: "btn btn-success",
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Esportar a PDF",
          className: "btn btn-danger",
        },
        {
          extend: "csvHtml5",
          text: "<i class='fas fa-file-csv'></i> CSV",
          titleAttr: "Esportar a CSV",
          className: "btn btn-info",
        },
        {
          extend: "print",
          text: "<i class='fa fa-print' aria-hidden='true'></i>Impresión",
          titleAttr: "Esportar a CSV",
          className: "btn btn-dark",
        },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "asc"]],
    });
  
  let formClientes = document.querySelector("#formClientes");
  formClientes.onsubmit = function (e) {
    e.preventDefault();
    let strIdentificacion = document.querySelector("#txtIdentificacion").value;
    let strNombre = document.querySelector("#txtNombre").value;
    let strApellido = document.querySelector("#txtApellido").value;
    let strEmail = document.querySelector("#txtEmail").value;
    let intTelefono = document.querySelector("#txtTelefono").value;
    let strpassword = document.querySelector("#txtPassword").value;
    let intRuc = document.querySelector("#txtRuc").value;
    let strRazSocial = document.querySelector("#txtRSocial").value;
    let srtDirFiscal = document.querySelector("#txtDireccionFiscal").value;

    if (
      strIdentificacion == "" ||
      strApellido == "" ||
      strNombre == "" ||
      strEmail == "" ||
      intTelefono == "" ||
      intRuc == "" ||
      strRazSocial == "" ||
      srtDirFiscal == "" 
    ) {
      swal("Atención", "Todos los campos son obligatorios.", "error");
      return false;
    }

    let elementsValid = document.getElementsByClassName("valid");
    for (let i = 0; i < elementsValid.length; i++) {
      if (elementsValid[i].classList.contains("is-invalid")) {
        swal("Atención", "Por favor verifique los campos en rojo.", "error");
        return false;
      }
    }
    divLoading.style.display = "flex";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxUrl = BASE_URL + "Clientes/setCliente";
    let formData = new FormData(formClientes);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          $("#modalfrmClientes").modal("hide");
          formClientes.reset();
          tableClientes.ajax.reload(null, false);
          swal("Clientes", objData.msg, "success");
        } else {
          swal("Error", objData.msg, "error");
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
}, false);

function fntViewCliente(id_usuario) {
  let idusuario = id_usuario;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = BASE_URL + "Clientes/getCliente/" + idusuario;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {

        document.querySelector("#celIdentificacion").innerHTML =
          objData.data.dni;
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celApellido").innerHTML =
          objData.data.apellidos;
        document.querySelector("#celTelefono").innerHTML =
          objData.data.telefono;
        document.querySelector("#celEmail").innerHTML = objData.data.correo;
        document.querySelector("#ruc").innerHTML = objData.data.ruc;
        document.querySelector("#nameRSocial").innerHTML = objData.data.razonSocial;
        document.querySelector("#dirFiscal").innerHTML = objData.data.direccion;
        document.querySelector("#celFechaRegistro").innerHTML =
          objData.data.fechaRegistro;
        $("#modalWiewCliente").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
function fntEditCliente(id_usuario) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Cliente";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerUpdate");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let idusuario = id_usuario;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = BASE_URL + "Clientes/getCliente/" + idusuario;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idCliente").value = objData.data.id_usuario;
        document.querySelector("#txtIdentificacion").value = objData.data.dni;
        document.querySelector("#txtNombre").value = objData.data.nombre;
        document.querySelector("#txtApellido").value = objData.data.apellidos;
        document.querySelector("#txtTelefono").value = objData.data.telefono;
        document.querySelector("#txtEmail").value = objData.data.correo;
        document.querySelector("#txtRuc").value = objData.data.ruc
        document.querySelector("#txtRSocial").value = objData.data.razonSocial
        document.querySelector("#txtDireccionFiscal").value = objData.data.direccion
      }
    }
    $("#modalfrmClientes").modal("show");
  };
}
function fntDelCliente(id_usuario) {
  let idusuario = id_usuario;

  swal({
    title: "Eliminar Cliente",
    text: "¿Realmente quiere eliminar el Cliente?",
    icon: "warning",
    buttons: ["No, cancelar", "Si, eliminar"],
    dangerMode: true,
  }).then((value) => {
    if (value) {
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = BASE_URL + "Clientes/delCliente/";
      let strData = "idUsuario=" + idusuario;
      request.open("POST", ajaxUrl, true);
      request.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      request.send(strData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            swal("Eliminar!", objData.msg, "success");
            tableClientes.ajax.reload();
          } else {
            swal("Atención!", objData.msg, "error");
          }
        }
      };
    }
  });
}
function abrirModClientes() {
  document.querySelector("#idCliente").value = "";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Cliente";
  document.querySelector("#formClientes").reset();
  $("#liststatus").val("");
  $("#modalfrmClientes").modal("show"); 
}