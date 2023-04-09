
let tableUsuarios;
let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){

    tableUsuarios = $('#datatblUsuarios').DataTable({
        "select": true,
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
        },
        "ajax": {
            "url": "" + BASE_URL + "Usuarios/getUsuarios",
            "dataSrc": "",
        },
        "columns": [
            { "data": "id_usuario" },
            { "data": "nombre" },
            { "data": "apellidos" },
            { "data": "correo" },
            { "data": "telefono" },
            { "data": "rol" },
            { "data": "status" },
            { "data": "options" }
        ],
        'dom': 'lBfrtip',
        'buttons': [
            
          {
                "extend": "copyHtml5",
                "text": "<i class='far fa-copy'></i> Copiar",
                "titleAttr": "Copiar",
                "className": "btn btn-secondary"
            }, {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Esportar a Excel",
                "className": "btn btn-success"
            }, {
                "extend": "pdfHtml5",
                "text": "<i class='fas fa-file-pdf'></i> PDF",
                "titleAttr": "Esportar a PDF",
                "className": "btn btn-danger"
            }, {
                "extend": "csvHtml5",
                "text": "<i class='fas fa-file-csv'></i> CSV",
                "titleAttr": "Esportar a CSV",
                "className": "btn btn-info"
            },{
                "extend": "print",
                "text": "<i class='fa fa-print' aria-hidden='true'></i>Impresión",
                "titleAttr": "Esportar a CSV",
                "className": "btn btn-dark"
            }
    
      ],
      "resonsieve":"true",
      "bDestroy": true,
      "iDisplayLength": 3,
      "order":[[0,"asc"]]  
  });

    let formUsuario = document.querySelector("#formUsuarios");
    formUsuario.onsubmit = function(e) {
        e.preventDefault();
        let strIdentificacion = document.querySelector('#txtIdentificacion').value;
        let strNombre = document.querySelector('#txtNombre').value;
        let strApellido = document.querySelector('#txtApellido').value;
        let strEmail = document.querySelector('#txtEmail').value;
        let intTelefono = document.querySelector('#txtTelefono').value;
      let intTipousuario = document.querySelector('#listRolid').value;
      let srtUsuario = document.querySelector("#txtUsuario").value;
        let strPassword = document.querySelector('#txtPassword').value;

        if(strIdentificacion == '' || strApellido == '' || strNombre == '' || strEmail == '' || intTelefono == '' || intTipousuario == '' || srtUsuario=='')
        {
            swal("Atención", "Todos los campos son obligatorios." , "error");
            return false;
        }

        let elementsValid = document.getElementsByClassName("valid");
        for (let i = 0; i < elementsValid.length; i++) { 
            if(elementsValid[i].classList.contains('is-invalid')) { 
                swal("Atención", "Por favor verifique los campos en rojo." , "error");
                return false;
            } 
        } 
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = BASE_URL+'Usuarios/setUsuario'; 
        let formData = new FormData(formUsuario);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                if(objData.status)
                {
                    $("#modalfrmUsuarios").modal("hide");
                    formUsuario.reset();
                    tableUsuarios.ajax.reload(null,false);
                    swal("Usuarios", objData.msg, "success");
                }else{
                    swal("Error", objData.msg , "error");
                }
            }
            divLoading.style.display = "none";
            return false;
        }

    }
}, false);

window.addEventListener('load', function() {
        fntRolesUsuario();
        // fntViewUsuario();
        // fntEditUsuario();
        // fntDelUsuario();
}, false);
function fntRolesUsuario(){
    let ajaxUrl = BASE_URL+'Roles/getSelectRoles';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            document.querySelector('#listRolid').innerHTML = request.responseText;
            $('#listRolid').selectpicker('render');
        }
    }
    
}
function fntViewUsuario(id_usuario){
    let idusuario = id_usuario;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = BASE_URL + "Usuarios/getUsuario/" + idusuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
               let estadoUsuario = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celIdentificacion").innerHTML = objData.data.dni;
                document.querySelector("#celNombre").innerHTML = objData.data.nombre;
                document.querySelector("#celApellido").innerHTML = objData.data.apellidos;
                document.querySelector("#celTelefono").innerHTML = objData.data.telefono;
                document.querySelector("#celEmail").innerHTML = objData.data.correo;
                document.querySelector("#celTipoUsuario").innerHTML = objData.data.rol;
                document.querySelector("#celEstado").innerHTML = estadoUsuario;
                document.querySelector("#celFechaRegistro").innerHTML = objData.data.fechaRegistro; 
                $("#modalWiewUsuario").modal("show");
            }else{
                swal("Error", objData.msg , "error");
            }
        }
        
    }
}
function fntEditUsuario(id_usuario) {
    document.querySelector('#titleModal').innerHTML ="Actualizar Usuario";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    let idusuario = id_usuario;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = BASE_URL+'Usuarios/getUsuario/'+idusuario;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){

        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);

            if(objData.status)
            {
                document.querySelector("#idUsuario").value = objData.data.id_usuario;
                document.querySelector("#txtIdentificacion").value = objData.data.dni;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtApellido").value = objData.data.apellidos;
                document.querySelector("#txtTelefono").value = objData.data.telefono;
                document.querySelector("#txtEmail").value = objData.data.correo;
                document.querySelector("#listRolid").value = objData.data.id_tipous;
                document.querySelector("#txtUsuario").value =objData.data.user;
                $('#listRolid').selectpicker('render');

                if(objData.data.status == 1){
                    document.querySelector("#listStatus").value = 1;
                }else{
                    document.querySelector("#listStatus").value = 2;
                }
                $('#listStatus').selectpicker('render');
            }
        }
        $('#modalfrmUsuarios').modal('show');
    }
}
function fntDelUsuario(id_usuario) { 

      let idusuario = id_usuario;

      swal({
        title: "Eliminar Usuario",
        text: "¿Realmente quiere eliminar el Usuario?",
        icon: "warning",
        buttons: ["No, cancelar", "Si, eliminar"],
        dangerMode: true,
      }).then((value) =>{
          if (value) {
          let request = window.XMLHttpRequest
            ? new XMLHttpRequest()
            : new ActiveXObject("Microsoft.XMLHTTP");
          let ajaxUrl = BASE_URL + "Usuarios/delUsuario/";
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
                swal("Eliminar!", objData.msg,"success");
                  tableUsuarios.ajax.reload();
              } else {
                swal("Atención!", objData.msg, "error");
              }
            }
          }
        } 
      });
}
function abrirModUsuarios() {
    tableUsuarios.ajax.reload();
  document.querySelector("#idUsuario").value = "";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Rol";
  document.querySelector("#formUsuarios").reset();
  $("#liststatus").val("");
  $("#modalfrmUsuarios").modal("show");
}


    


