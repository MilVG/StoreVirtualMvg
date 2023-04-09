let tableCategorias;
let divLoading = document.querySelector("#divLoading");
document.addEventListener(
  "DOMContentLoaded",
  function () {
    tableCategorias = $("#datatblCategorias").DataTable({
      select: true,
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
      },
      ajax: {
        url: "" + BASE_URL + "Categorias/getCategorias",
        dataSrc: "",
      },
      columns: [
        { data: "id_Categoria" },
        { data: "nombre" },
        { data: "descripcion" },
        { data: "status" },
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

    if (document.querySelector("#foto")) {
      var foto = document.querySelector("#foto");
      foto.onchange = function (e) {
        var uploadFoto = document.querySelector("#foto").value;
        var fileimg = document.querySelector("#foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.querySelector("#form_alert");
        if (uploadFoto != "") {
          var type = fileimg[0].type;
          var name = fileimg[0].name;
          if (
            type != "image/jpeg" &&
            type != "image/jpg" &&
            type != "image/png"
          ) {
            contactAlert.innerHTML =
              '<p class="errorArchivo">El archivo no es válido.</p>';
            if (document.querySelector("#img")) {
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.add("notBlock");
            foto.value = "";
            return false;
          } else {
            contactAlert.innerHTML = "";
            if (document.querySelector("#img")) {
              document.querySelector("#img").remove();
            }
            document.querySelector(".delPhoto").classList.remove("notBlock");
            var objeto_url = nav.createObjectURL(this.files[0]);
            document.querySelector(".prevPhoto div").innerHTML =
              "<img id='img' src=" + objeto_url + ">";
          }
        } else {
          alert("No selecciono foto");
          if (document.querySelector("#img")) {
            document.querySelector("#img").remove();
          }
        }
      };
    }

    if (document.querySelector(".delPhoto")) {
      var delPhoto = document.querySelector(".delPhoto");
      delPhoto.onclick = function (e) {
        document.querySelector("#foto_remove").value = 1;
        removePhoto();
      };
    }

    let formCategorias = document.querySelector("#formCategorias");
    formCategorias.onsubmit = function (e) {
      e.preventDefault();
      let strNombre = document.querySelector("#txtnombre").value;
      let strDescripcion = document.querySelector("#txtDescripcion").value;
      let intEstado = document.querySelector("#liststatus").value;
      if (strNombre == "" || strDescripcion == "" || intEstado == "") {
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
      let ajaxUrl = BASE_URL + "Categorias/setCategorias";
      let formData = new FormData(formCategorias);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            $("#modalfrmCategorias").modal("hide");
            formCategorias.reset();
            removePhoto();
            tableCategorias.ajax.reload();
            swal("Categorias", objData.msg, "success");
          } else {
            swal("Error", objData.msg, "error");
          }
        }
        divLoading.style.display = "none";
        return false;
      };
    };
  },
  false
);

function removePhoto() {
  document.querySelector("#foto").value = "";
  document.querySelector(".delPhoto").classList.add("notBlock");
  if (document.querySelector("#img")) {
    document.querySelector("#img").remove();
  }
}

function fntViewCategoria(id_categoria) {
  let idcategoria = id_categoria;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = BASE_URL + "Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {

         let estado = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
          '<span class="badge badge-danger">Inactivo</span>';
        
        document.querySelector("#celNombre").innerHTML = objData.data.nombre;
        document.querySelector("#celDescripcion").innerHTML = objData.data.descripcion;
        document.querySelector("#celStatus").innerHTML = estado ;
        document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro;
        document.querySelector("#celPortada").innerHTML = '<img src="'+objData.data.url_portada +'"></img>';
        $("#modalWiewCategoria").modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
function fntEditCategoria(id_categoria) {
  document.querySelector("#titleModal").innerHTML = "Actualizar Categoria";
  document.querySelector(".modal-header").classList.replace("headerRegister", "headerUpdate");
  document.querySelector("#btnActionForm").classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Actualizar";

  let idcategoria = id_categoria;
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = BASE_URL + "Categorias/getCategoria/" + idcategoria;
  request.open("GET", ajaxUrl, true);
  request.send();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idCategorias").value =
          objData.data.id_Categoria;
        document.querySelector("#txtnombre").value = objData.data.nombre;
        document.querySelector("#txtDescripcion").value =
          objData.data.descripcion;
        document.querySelector("#foto_actual").value = objData.data.portadaimg;
        document.querySelector("#foto_remove").value = 0;

          if (objData.data.status) {
            document.querySelector("#liststatus").value = 1;
          } else {
            document.querySelector("#liststatus").value = 2;
          }
          $("#liststatus").selectpicker("render");

          if (document.querySelector("#img")) {
            document.querySelector("#img").src = objData.data.url_portada;
          } else {
            document.querySelector(".prevPhoto div").innerHTML =
              "<img id='img' src=" + objData.data.url_portada + ">";
          }

          if (objData.data.portadaimg == "portada_categoria.png") {
            document.querySelector(".delPhoto").classList.add("notBlock");
          } else {
            document.querySelector(".delPhoto").classList.remove("notBlock");
          }

        $('#modalfrmCategorias').modal("show");
      } else {
        swal("Error", objData.msg, "error");
      }
    } 
  }
}
function fntDelCategoria(id_categoria) {
  let idcategoria = id_categoria;

  swal({
    title: "Eliminar Categoria",
    text: "¿Realmente quiere eliminar el Categoria?",
    icon: "warning",
    buttons: ["No, cancelar", "Si, eliminar"],
    dangerMode: true,
  }).then((value) => {
    if (value) {
      let request = window.XMLHttpRequest
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxUrl = BASE_URL + "Categorias/delCategoria";
      let strData = "idCategoria=" + idcategoria;
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
            tableCategorias.ajax.reload();
          } else {
            swal("Atención!", objData.msg, "error");
          }
        }
      };
    }
  });
}
function abrirModCategorias() {
  document.querySelector("#idCategorias").value = "";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nueva Categoria";
  document.querySelector("#formCategorias").reset();
  $("#modalfrmCategorias").modal("show");
  removePhoto(); 
}
