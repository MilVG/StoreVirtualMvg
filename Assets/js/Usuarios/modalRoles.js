let datatablef;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function () {
   datatablef= $("#datatblRoles").DataTable({
    "select":true,
    "processing": true,
    "aserverSide": true,
    "language": {
      "url": "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
    },
    "ajax": {
      "url": " "+ BASE_URL+"Roles/getRoles",
      "dataSrc": "",
    },
    "columns": [
      { "data": "id_tipous" },
      { "data": "rol" },
      { "data": "status" },
      { "data": "options" },
    ],
    "resonsieve": "true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order": [[0, "asc"]],
  });
  let formRol = document.querySelector("#formRoles");
  formRol.onsubmit = function (e) {
    e.preventDefault();

    let intIdRol = document.querySelector("#idRol").value;
    let strnombre = document.querySelector("#txtnombre").value;
    let status = document.querySelector("#liststatus").value;
    if (strnombre == "" || status == "") {
      swal("Atención", "Todos los campos son abligatorios!", "error");
      return false;
    }
    divLoading.style.display = "flex";
    let request = (window.XMLHttpRequest)
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    let ajaxurl = BASE_URL+'Roles/setRol';
    let formData = new FormData(formRol);
    request.open("POST", ajaxurl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      
      if (request.readyState == 4 && request.status == 200) {
        
        let objData = JSON.parse(request.responseText);

        if (objData.status) {
          $('#modalfrmRoles').modal("hide");
          formRol.reset();
          swal("Roles de usuario", objData.msg, "success");
          datatablef.ajax.reload();
        } else  
          swal("Error", objData.msg, "error");
        
      }
      divLoading.style.display = "none";
      return false;
    }
  }
});

$('#datatblroles').DataTable();

function abrirModRol() {

  document.querySelector('#idRol').value = "";
  document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
  document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#titleModal').innerHTML = "Nuevo Rol";
  document.querySelector('#formRoles').reset();
 $("#liststatus").val("");
  $("#modalfrmRoles").modal('show');
}

// window.addEventListener('load', function () {
//   // fntEditRol();
//   // fntDelRol();
//   // fntPermisos();
// },false);

function fntEditRol(id_rol) { 
      document.querySelector('#titleModal').innerHTML = "Actualizar Rol";
      document.querySelector('.modal-header').classList.replace('headerRegister', "headerUpdate");
      document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
      document.querySelector('#btnText').innerHTML = "Actualizar";
      
      let idrol = id_rol;
      let request = (window.XMLHttpRequest)
        ? new XMLHttpRequest()
        : new ActiveXObject("Microsoft.XMLHTTP");
      let ajaxetUser = BASE_URL + 'Roles/getRol/' + idrol;
      request.open("GET", ajaxetUser, true);
      request.send();

      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          
          let objData = JSON.parse(request.responseText);

          if (objData.status) {
            document.querySelector("#idRol").value = objData.data.id_tipous;
            document.querySelector("#txtnombre").value = objData.data.rol;
            if (objData.data.status == 1) {
              var optionSelect = '<option value="1" selected class="notBlock">Activo</option>';

            } else {
              var optionSelect =
                '<option value="2" selected class="notBlock">Inactivo</option>';
              
            }
            let htmlSelect = `${optionSelect}
              <option value="1"> Activo</option>
              <option value="2">Inactivo</option>   
            `;
            document.querySelector("#liststatus").innerHTML = htmlSelect;
            $("#modalfrmRoles").modal("show");
          } else {
            swal("Error", objData.msg, "error");
          }

        }
      }
      
}

function fntDelRol(id_rol) {
      let idrol = id_rol;

      swal({
        title: "Eliminar Rol",
        text: "¿Realmente quiere eliminar el Rol?",
        icon: "warning",
        buttons: ["No, cancelar", "Si, eliminar"],
        dangerMode: true,
      }).then((value) =>{
        if (value) {
          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          let ajaxUrl = BASE_URL + "Roles/delRol/";
          let strData = "idrol=" + idrol;
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
                swal("Eliminar!", objData.msg,"success");
                datatablef.ajax.reload();
              } else {
                swal("Atención!", objData.msg, "error");
              }
            }
          }
        } 
      });
}

function fntPermisos(id_rol) { 
       let idrol = id_rol;
       let request = window.XMLHttpRequest
         ? new XMLHttpRequest()
         : new ActiveXObject("Microsoft.XMLHTTP");
       let ajaxetUser = BASE_URL + "Permisos/getPermisosRol/" + idrol;
       request.open("GET", ajaxetUser, true);
      request.send();
      
      request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
          document.querySelector("#contentAjax").innerHTML =request.responseText;
          $("#modalPermisos").modal("show");
          document.querySelector("#formPermisos").addEventListener("submit", fntSavePermisos, false);
        }
      }
}

function fntSavePermisos(evnet) {
  evnet.preventDefault();
  let request = window.XMLHttpRequest
    ? new XMLHttpRequest()
    : new ActiveXObject("Microsoft.XMLHTTP");
  let ajaxUrl = BASE_URL + "Permisos/setPermisos";
  let formElement = document.querySelector("#formPermisos");
  let formData = new FormData(formElement);
  request.open("POST", ajaxUrl, true);
  request.send(formData);

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);
      if (objData.status) {
        swal("Permisos de usuario", objData.msg, "success");
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}
