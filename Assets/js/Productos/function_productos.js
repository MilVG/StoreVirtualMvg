
document.write(
  `<script src="${BASE_URL}Assets/vendor/plugins/js/JsBarcode.all.min.js"></script> `
);
let tableProductos;
let divLoading = document.querySelector("#divLoading");
window.addEventListener("DOMContentLoaded", function () {
  
    tableProductos = $("#datatblProductos").DataTable({
      select: true,
      aProcessing: true,
      aServerSide: true,
      language: {
        url: "" + BASE_URL + "Assets/vendor/plugins/datatableEspañol.json",
      },
      ajax: {
        url: "" + BASE_URL + "Productos/getProductos",
        dataSrc: "",
      },
      columns: [
        { data: "id_Producto" },
        { data: "codigo" },
        { data: "nombre" },
        { data: "precio" },
        { data: "stock" },
        { data: "status" },
        { data: "options" },
      ],
      columnDefs: [
        { className: "textcenter", targets: [3] },
        { className: "textright", targets: [4] },
        { className: "textcenter", targets: [5] },
      ],
      dom: "lBfrtip",
      buttons: [
        {
          extend: "copyHtml5",
          text: "<i class='far fa-copy'></i> Copiar",
          titleAttr: "Copiar",
          className: "btn btn-secondary",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "excelHtml5",
          text: "<i class='fas fa-file-excel'></i> Excel",
          titleAttr: "Esportar a Excel",
          className: "btn btn-success",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "pdfHtml5",
          text: "<i class='fas fa-file-pdf'></i> PDF",
          titleAttr: "Esportar a PDF",
          className: "btn btn-danger",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "csvHtml5",
          text: "<i class='fas fa-file-csv'></i> CSV",
          titleAttr: "Esportar a CSV",
          className: "btn btn-info",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
        {
          extend: "print",
          text: "<i class='fa fa-print' aria-hidden='true'></i>Impresión",
          titleAttr: "Esportar a CSV",
          className: "btn btn-dark",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5],
          },
        },
      ],
      resonsieve: "true",
      bDestroy: true,
      iDisplayLength: 10,
      order: [[0, "asc"]],
    });
    if (document.querySelector("#formProductos")) {
      let formProductos = document.querySelector("#formProductos");
      formProductos.onsubmit = function (e) { 
         e.preventDefault();
          let strNombre = document.querySelector('#txtNombre').value;
          let intCodigo = document.querySelector('#txtCodigo').value;
          let strPrecio = document.querySelector('#txtPrecio').value;
          let intStock = document.querySelector('#txtStock').value;
          let intStatus = document.querySelector('#listStatus').value;
          if(strNombre == '' || intCodigo == '' || strPrecio == '' || intStock == '' )
          {
              swal("Atención", "Todos los campos son obligatorios." , "error");
              return false;
          }
          if(intCodigo.length < 5){
              swal("Atención", "El código debe ser mayor que 5 dígitos." , "error");
              return false;
          }
          divLoading.style.display = "flex";
          tinyMCE.triggerSave();
          let request = (window.XMLHttpRequest) ? 
                          new XMLHttpRequest() : 
                          new ActiveXObject('Microsoft.XMLHTTP');
          let ajaxUrl = BASE_URL+'Productos/setProductos'; 
          let formData = new FormData(formProductos);
          request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState == 4 && request.status == 200) { 
            let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                      swal("", objData.msg, "success");
                      tableProductos.ajax.reload(null,false);
                      document.querySelector("#idProductos").value = objData.id_Producto;
                      document.querySelector("#containerGallery").classList.remove("notblock");
                    }else{
                      swal("Error", objData.msg , "error");
                    }
          }
          divLoading.style.display = "none";
          return false;
        }
      }
    }
    if (document.querySelector(".btnAddImage")) {
      let btnAddImage = document.querySelector(".btnAddImage");
      btnAddImage.onclick = function (e) {
        let key = Date.now();
        let newElement = document.createElement("div");
        newElement.id = "div" + key;
        newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div" + key + " .btnUploadfile").click();
        fntInputFile();
      }
    }
    fntInputFile();
    fntCategorias();
  },false);
if (document.querySelector("#txtCodigo")) {
  let inputCodigo = document.querySelector("#txtCodigo");
  inputCodigo.onkeyup = function () {
    if (inputCodigo.value.length >= 5) {
      document.querySelector("#divBarCode").classList.remove("notBlock");
      fntBarcode();
    } else {
      document.querySelector("#divBarCode").classList.add("notBlock");
    }
  };
}
tinymce.init({
  selector: "#txtDescripcion",
  width: "100%",
  height: 400,
  statubar: true,
  plugins: [
    "advlist",
    "autolink",
    "lists",
    "link",
    "image",
    "charmap",
    "preview",
    "anchor",
    "searchreplace",
    "visualblocks",
    "code",
    "fullscreen",
    "insertdatetime",
    "media",
    "table",
    "help",
    "wordcount",
  ],
  toolbar:
    "undo redo | blocks | " +
    "bold italic backcolor | alignleft aligncenter " +
    "alignright alignjustify | bullist numlist outdent indent | " +
    "removeformat | help",
  content_style:
    "body { font-family:Helvetica,Arial,sans-serif; font-size:16px }",
});

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idProducto = document.querySelector("#idProductos").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${BASE_URL}Assets/img/uploads/loading1.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = BASE_URL+'Productos/setImage'; 
                    let formData = new FormData();
                    formData.append('idproducto',idProducto);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notBlock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notBlock");
                            }else{
                                swal("Error", objData.msg , "error");
                            }
                        }
                    }

                }
            }

        });
    });
}
function fntDelItem(element){
    let nameImg = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idProducto = document.querySelector("#idProductos").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = BASE_URL+'Productos/delFile'; 

    let formData = new FormData();
    formData.append('idproducto',idProducto);
    formData.append("file",nameImg);
    request.open("POST",ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                swal("", objData.msg , "error");
            }
        }
    }
}
function fntViewProducto(idProducto){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = BASE_URL+'Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                let estadoProducto = objProducto.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';

                document.querySelector("#celCodigo").innerHTML = objProducto.codigo;
                document.querySelector("#celNombre").innerHTML = objProducto.nombre;
                document.querySelector("#celPrecio").innerHTML = objProducto.precio;
                document.querySelector("#celStock").innerHTML = objProducto.stock;
                document.querySelector("#celCategoria").innerHTML = objProducto.categoria;
                document.querySelector("#celStatus").innerHTML = estadoProducto;
                document.querySelector("#celDescripcion").innerHTML = objProducto.descripcion;

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        htmlImage +=`<img src="${objProductos[p].url_image}"></img>`;
                    }
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $("#modalWiewProducto").modal("show");

            }else{
                swal("Error", objData.msg , "error");
            }
        }
    } 
}
function fntEditProducto(idProducto){
    //rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = BASE_URL+'Productos/getProducto/'+idProducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objProducto = objData.data;
                document.querySelector("#idProductos").value = objProducto.id_Producto;
                document.querySelector("#txtNombre").value = objProducto.nombre;
                document.querySelector("#txtDescripcion").value = objProducto.descripcion;
                document.querySelector("#txtCodigo").value = objProducto.codigo;
                document.querySelector("#txtPrecio").value = objProducto.precio;
                document.querySelector("#txtStock").value = objProducto.stock;
                document.querySelector("#listCategoria").value = objProducto.categoriaid;
                document.querySelector("#listStatus").value = objProducto.status;
                tinymce.activeEditor.setContent(objProducto.descripcion); 
                $('#listCategoria').selectpicker('render');
                $('#listStatus').selectpicker('render');
                fntBarcode();

                if(objProducto.images.length > 0){
                    let objProductos = objProducto.images;
                    for (let p = 0; p < objProductos.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objProductos[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgname="${objProductos[p].img}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#divBarCode").classList.remove("notBlock");
                document.querySelector("#containerGallery").classList.remove("notBlock");           
                $('#modalfrmProductos').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}
function fntDelProducto(id_Producto) {
  let idProducto = id_Producto;

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
      let ajaxUrl = BASE_URL + "Productos/delProducto";
      let strData = "idProducto=" + idProducto;
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
            tableProductos.ajax.reload();
          } else {
            swal("Atención!", objData.msg, "error");
          }
        }
      };
    }
  });
}
function fntCategorias() {
  if (document.querySelector("#listCategoria")) {
    let ajaxUrl = BASE_URL + "Categorias/getSelectCategorias";
    let request = window.XMLHttpRequest
      ? new XMLHttpRequest()
      : new ActiveXObject("Microsoft.XMLHTTP");
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        document.querySelector("#listCategoria").innerHTML =
          request.responseText;
        $("#listCategorias").selectpicker("render");
      }
    };
  }
}
function fntBarcode() {
  let codigo = document.querySelector("#txtCodigo").value;
  JsBarcode("#barcode", codigo);
}
function fntPrintBarcode(area) {
  let elemntArea = document.querySelector(area);
  let vprint = window.open(" ", "popimpr", "height = 400, width=600 center");
  vprint.document.write(elemntArea.innerHTML);
  vprint.document.close();
  vprint.print();
  vprint.close();
}
function abrirModProductos() {
  tableProductos.ajax.reload();
  document.querySelector("#idProductos").value = "";
  document.querySelector(".modal-header").classList.replace("headerUpdate", "headerRegister");
  document.querySelector("#btnActionForm").classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Guardar";
  document.querySelector("#titleModal").innerHTML = "Nuevo Producto";
  document.querySelector("#formProductos").reset();
  $("#liststatus").val("");
  document.querySelector("#divBarCode").classList.add("notBlock");
  document.querySelector("#containerGallery").classList.add("notBlock");
  document.querySelector("#containerImages").innerHTML = "";
  $("#modalfrmProductos").modal("show");
}
