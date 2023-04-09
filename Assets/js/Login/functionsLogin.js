

const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
if (sign_up_btn) {
  sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
  });
}
if (sign_in_btn) {
  sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
  });
}

let divLoading = document.querySelector("#divLoading");
document.addEventListener('DOMContentLoaded', function(){
  if (document.querySelector("#frmLogin")) {
    let formLogin = document.querySelector("#frmLogin");
    formLogin.onsubmit =function(e){
      e.preventDefault();

      let srtEmail = document.querySelector('#txtCorreo').value;
      let srtPassword = document.querySelector("#txtpassword").value;
      if (srtEmail =="" || srtPassword=="") {
        swal("Por favor", "Escribe usuario y contraseña.","error");
        return false;
      }else{
        divLoading.style.display = "flex";
        let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        let ajaxUrl = BASE_URL+'/Login/loginUser'; 
        let formData = new FormData(formLogin);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
          if (request.readyState !=4) return;

          if (request.status ==200) {
            let objData =JSON.parse(request.responseText);
            if (objData.status) {
              //window.location=BASE_URL+'Dashboard';
              window.location.reload(false);
            }else{
              swal("Atención",objData.msg,"error");
              document.querySelector('#txtpassword').value="";
            }
          }else{
            swal("Atención","Error en el proceso","error");
          }
          divLoading.style.display = "none";
          return false;
        }
      }
    }
  }
  if(document.querySelector("#formRecetPass")){   
    let formRecetPass = document.querySelector("#formRecetPass");
    formRecetPass.onsubmit = function(e) {
      e.preventDefault();

      let strEmail = document.querySelector('#txtEmailReset').value;
      if(strEmail == "")
      {
        swal("Por favor", "Escribe tu correo electrónico.", "error");
        return false;
      }else{
        
        let request = (window.XMLHttpRequest) ? 
                new XMLHttpRequest() : 
                new ActiveXObject('Microsoft.XMLHTTP');
                
        let ajaxUrl = BASE_URL+'Login/resetPass'; 
        let formData = new FormData(formRecetPass);
        request.open("POST",ajaxUrl,true);
        request.send(formData);
        request.onreadystatechange = function(){
          if(request.readyState != 4) return;

          if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
              swal({
                title: "",
                text: objData.msg,
                icon: "success",
                button:"Aceptar",
              }).then ((isConfirm) =>{
                if (isConfirm) {
                  window.location = BASE_URL;
                }
              });
            }else{
              swal("Atención", objData.msg, "error");
            }
          }else{
            swal("Atención","Error en el proceso", "error");
          }
          
        } 
      }
    }
  }
},false);


