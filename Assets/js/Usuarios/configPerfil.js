// funciones para configurar perfil de usuario.

let cuenta = document.querySelector("#ConfigCuenta");
let confPass = document.querySelector("#perfilpassword");
if (cuenta != undefined) {
    cuenta.style.cursor = "pointer"
    cuenta.addEventListener("click", function (e) {
    confPass.classList.remove("select", "active");
    cuenta.classList.add("select", "active");
    document.querySelector("#password").style.display = "none";
    document.querySelector("#account").style.display = "inline";

}, false);
}

if (confPass != undefined) {
    confPass.style.cursor = "pointer"
    confPass.addEventListener("click",function (e) {
    cuenta.classList.remove("select", "active");
    confPass.classList.add("select", "active");
    document.querySelector("#password").style.display = "inline";
    document.querySelector("#account").style.display = "none";
  },false);    
}

// abrir los datos del formulario informacion privada del perfil de usuario.
btnWiewDta = $("#btnWiewData");
if (btnWiewDta !=undefined) {
  btnWiewDta.click(function () {
    $("#showDtainfo").slideToggle("slow", function () {
      if ($("#showDtainfo").is(":hidden")) {
        document.querySelector('#infoPri').reset();
        $("#infoPri input").removeClass("is-invalid");
            
      } else {
        $(".toast").toast("show");
        document.querySelector("#showDtainfo").scrollIntoView();
        
      }
    });
  });
}

//funcion para actualizar datos de perfil de usuario

function upAsincronoprueba() {
  let frmdatosper = document.querySelector("#infoPri");
  
  swal({
    title: "Actualizar",
    text: "¿Realmente quieres Actualizar tu información ?",
    icon: "warning",
    buttons: ["No, cancelar", "Si, Actualizar"],
    dangerMode: true,
  }).then((value) => {
    if (value) { 
      actualizarDatos();
    } else {
      $("#showDtainfo").slideUp();
    }
  });
  async function actualizarDatos() {
    
    let url = BASE_URL + "Usuarios/upInfoPrivate";
    let strNombre = document.querySelector("#txtnombre").value;
    let strApellido = document.querySelector("#txtapellidos").value;
    let strDni = document.querySelector("#txtdni").value;
    let strDireccion = document.querySelector("#txtdireccion").value;
    let intTelefono = document.querySelector("#txttelefono").value;

    if (
      strNombre == "" ||
      strApellido == "" ||
      strDni == "" ||
      strDireccion == "" ||
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
    try {

      const data = new FormData(frmdatosper)
      let option = {
        method: "POST",
        mode: 'cors',
        cache:'no-cache',
        body: data
      }
         
      let res = await fetch(url, option);
      
      json = await res.json();
      if (res.status) {
        swal({
          title: "¡Felicitaciones!",
          text: json.msg,
          icon: "success",
          button: "ok",

        }).then((value) => {
          if (value) {
            document.querySelector("#infoPri").reset();
            $("#showDtainfo").slideUp();
          }
        });
      } else {
        swal("Error", res.msg, "error");
      }
      
      return false;
    } catch (err) {
      console.log(err);
    }
  }

}






