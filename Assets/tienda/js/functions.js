
$(".js-select2").each(function(){
    $(this).select2({
        minimumResultsForSearch: 20,
        dropdownParent: $(this).next('.dropDownSelect2')
    });
})

$(".parallax100").parallax100();

$(".gallery-lb").each(function () {
  // the containers for all your galleries
  $(this).magnificPopup({
    delegate: "a", // the selector for gallery item
    type: "image",
    gallery: {
      enabled: true,
    },
    mainClass: "mfp-fade",
  });
});

$(".js-addwish-b2").on("click", function (e) {
      e.preventDefault();
    });

    $(".js-addwish-b2").each(function () {
      var nameProduct = $(this).parent().parent().find(".js-name-b2").html();
      $(this).on("click", function () {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass("js-addedwish-b2");
        $(this).off("click");
      });
    });

    $(".js-addwish-detail").each(function () {
      var nameProduct = $(this).parent().parent().parent().find(".js-name-detail").html();

      $(this).on("click", function () {
        swal(nameProduct, "is added to wishlist !", "success");

        $(this).addClass("js-addedwish-detail");
        $(this).off("click");
      });
    });

    /*---------------------------------------------*/

$(".js-addcart-detail").each(function () {
    var nameProduct = $(this).parent().parent().parent().parent().find(".js-name-detail").html();
    
    $(this).on("click", function () {
        let id = this.getAttribute('id');
        let cant = document.querySelector('#cant-product').value;
        
        if (isNaN(cant) || cant < 1) {
            swal("", "La cantidad debe ser mayor o igual  que 1", "error");
            return;
        }

        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('microsoft.XMLHTTP');
        let ajaxUrl = BASE_URL + 'Tienda/addCarrito';
        let formData = new FormData();
        formData.append('id', id);
        formData.append('cant', cant);

        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState != 4) return;
          if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.status) {
              document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
              cantcar = document.querySelectorAll(".cantCarrito");
              cantcar.forEach(element => {
                element.setAttribute("data-notify",objData.cantCarrito)
              });
              swal(nameProduct, "Se agregó al Carrito !", "success");
            } else {
              swal("", objData.msg, "error");
            }
          }
            return false;
        }
        
    });
});

$(".js-pscroll").each(function () {
  $(this).css("position", "relative");
  $(this).css("overflow", "hidden");
  var ps = new PerfectScrollbar(this, {
    wheelSpeed: 1,
    scrollingThreshold: 1000,
    wheelPropagation: false,
  });

  $(window).on("resize", function () {
    ps.update();
  });
});

/*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
      let numProduct = Number($(this).next().val());
      let idpr = this.getAttribute('idpr')
      if (numProduct > 1) $(this).next().val(numProduct - 1);
      let cant = $(this).next().val();
      if (idpr != null) {
        
        fntUpdateCant(idpr, cant);
      }
    });

    $('.btn-num-product-up').on('click', function () {
      let numProduct = Number($(this).prev().val());
      let idpr = this.getAttribute("idpr");
      $(this).prev().val(numProduct + 1);
      let cant = $(this).prev().val();
      if (idpr != null) {
        fntUpdateCant(idpr, cant);
      }
    });

    if (document.querySelector(".num-product")) {
      let inputCant = document.querySelectorAll(".num-product");
      inputCant.forEach(function (inputCant) {
        inputCant.addEventListener('keyup', function () {
          let idpr = this.getAttribute('idpr');
          let cant = this.value;
          if (idpr != null) {
            fntUpdateCant(idpr, cant);
          }
        });
      });
    }

if (document.querySelector(".methodpago")) {
  window.addEventListener('load', function () {
    $("#divtipopago").hide();
  })
  let metpago = document.querySelectorAll(".methodpago");
  metpago.forEach(function (metpago) {
    metpago.addEventListener("click", function () {
      if (this.value == "paypal") {
        // document.querySelector("#msgpaypal").style.display = '';
        // document.querySelector("#divtipopago").classList.add("notBlock");
        $("#divPaypal").show();
        $("#divtipopago").hide();
      } else {
        // document.querySelector("#divtipopago").classList.remove("notBlock");
        // document.querySelector("#msgpaypal").style.display = "none";
        $("#divtipopago").show();
        $("#divPaypal").hide();
      }
    });
  });
}

function fntdelItem(element) {
  //option 1 = modal
  //option 2 = vista carrito
  let option = element.getAttribute("op");
  let idpr = element.getAttribute("idpr");

  if (option == 1 || option == 2) {
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('microsoft.XMLHTTP');
        let ajaxUrl = BASE_URL + 'Tienda/delCarrito';
        let formData = new FormData();
        formData.append('id', idpr);
        formData.append('option', option);

        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
          if (request.readyState != 4) return;
          if (request.status == 200) {
            let objData = JSON.parse(request.responseText);
           
            if (objData.status) {
              if (option == 1) {
                document.querySelector("#productosCarrito").innerHTML = objData.htmlCarrito;
                 cantcar = document.querySelectorAll(".cantCarrito");
                 cantcar.forEach((element) => {
                   element.setAttribute("data-notify", objData.cantCarrito);
                 });
                
              } else {
                element.parentNode.parentNode.remove();
                document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
                document.querySelector("#totalCompra").innerHTML = objData.total;
                if (document.getElementById("#tblCarrito").rows.length == 1) {
                  window.location.href = BASE_URL;
                }
              }
            } else {
              swal("", objData.msg, "error");
            }
          }
            return false;
        }
        
  }

}

function fntUpdateCant(pro, cant) {
  if (cant <=0) {
    $('#btncomprar').hide();
  } else {
    $('#btncomprar').show();
      let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('microsoft.XMLHTTP');
      let ajaxUrl = BASE_URL + 'Tienda/updCarrito';
      let formData = new FormData();
      formData.append('id', pro);
      formData.append('cantidad', cant);
      request.open("POST", ajaxUrl, true);
      request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState != 4) return;
      if (request.status == 200) {
          let objData = JSON.parse(request.responseText);
          if (objData.status) {
            let colSubtotal = document.getElementsByClassName(pro)[0];
            colSubtotal.cells[4].textContent = objData.totalProducto;
            document.querySelector("#subTotalCompra").innerHTML = objData.subTotal;
            document.querySelector("#totalCompra").innerHTML = objData.total;
          } else {
            swal("", objData.msg, "error");
          }
      } 
      return false;
      }

  }
}

if (document.querySelector("#formRegister")) {
  let formRegister = document.querySelector("#formRegister");
  formRegister.onsubmit = function (e) {
    e.preventDefault();
    let strNombre = document.querySelector("#txtNombre").value;
    let strApellido = document.querySelector("#txtApellido").value;
    let strEmail = document.querySelector("#txtEmailCliente").value;
    let intTelefono = document.querySelector("#txtTelefono").value;

    if (
      strApellido == "" ||
      strNombre == "" ||
      strEmail == "" ||
      intTelefono == ""
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
    let ajaxUrl = BASE_URL + "Tienda/Registro";
    let formData = new FormData(formRegister);
    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);
        if (objData.status) {
          window.location.reload(false);
        } else {
          swal("Error", objData.msg, "error");
        }
      }
      divLoading.style.display = "none";
      return false;
    };
  };
}

document.addEventListener("DOMContentLoaded",function () {
  if (document.querySelector("#txtDireccion")) {
    let direccion = document.querySelectorAll("#txtDireccion");
    if ($("#txtDireccion").text() == "") {
      $("#divMetodoPago").hide();
    }
    direccion.forEach(function (direccion) {
      direccion.addEventListener("keyup", function () {
        let dir = this.value;
        fntViewPago(dir);
      });
    });
  }
  if (document.querySelector("#txtCiudad")) {
    let ciudad = document.querySelectorAll("#txtCiudad");
    if ($("#txtCiudad").text() == "") {
      $("#divMetodoPago").hide();
    }
    ciudad.forEach(function (ciudad) {
      ciudad.addEventListener("keyup", function () {
        let c = this.value;
        
        fntViewPago(c);
      });
    });
  }
},false);

function fntViewPago(dir, c) {
  let direccion = dir;
  let ciudad = c;
  if (direccion == "" || ciudad == "") {
    $("#divMetodoPago").hide();
  } else {
    $("#divMetodoPago").show();
    $("#optMetodoPago").hide();
  }
}
 if (document.querySelector("#btncomprar")) {

   let btnPago = document.querySelector("#btncomprar");
   btnPago.addEventListener('click', function () {
     let direccion = document.querySelector("#txtDireccion").value;
     let ciudad = document.querySelector("#txtCiudad").value;
     let inttipopago = document.querySelector("#listtipopago").value;
     if (direccion =="" || ciudad =="" || inttipopago =="") {
       swal("", "Complete datos de envío", "error");
       return;
     } else {
       divLoading.style.display = "flex";
       let request = window.XMLHttpRequest
         ? new XMLHttpRequest()
         : new ActiveXObject("microsoft.XMLHTTP");
       let ajaxurl = BASE_URL + "Tienda/procesarventa";
       let formData = new FormData();
       formData.append("direccion", direccion);
       formData.append("ciudad", ciudad);
       formData.append("inttipopago", inttipopago);
       request.open("POST", ajaxurl, true);
       request.send(formData);
       request.onreadystatechange = function () {
        if (request.readyState != 4) return;
         if (request.status == 200) {
           let objData = JSON.parse(request.responseText);
           if (objData.status) {
             window.location = BASE_URL + "Tienda/confirmarpedido";
           } else {
             swal("", objData, "error");
           }
         }
         divLoading.style.display = "none";
         return false;
       };
     }
     
    }, false);
 }


if (document.querySelector("#Condiciones")) {
  let opt = document.querySelector("#Condiciones");
  opt.addEventListener("click", function () {
    let option = this.checked;
   
    if (option) {
      $("#optMetodoPago").show();
    } else {
      $("#optMetodoPago").hide();
    }
  });
}