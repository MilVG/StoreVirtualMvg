document.addEventListener('DOMContentLoaded', function(){
	if(document.querySelector("#formCambiarPass")){
		let formCambiarPass = document.querySelector("#formCambiarPass");
		formCambiarPass.onsubmit = function(e) {
			e.preventDefault();

			let strPassword = document.querySelector('#txtPassword').value;
			let strPasswordConfirm = document.querySelector('#txtPasswordConfirm').value;
			let idUsuario = document.querySelector('#idUsuario').value;

			if(strPassword == "" || strPasswordConfirm == ""){
				swal("Por favor", "Escribe la nueva contraseña." , "error");
				return false;
			}else{
				if(strPassword.length < 5 ){
					swal("Atención", "La contrasenia debe tener un mínimo de 5 caracteres." , "info");
					return false;
				}
				if(strPassword != strPasswordConfirm){
					swal("Atencion", "Las contrasenias no son iguales." , "error");
					return false;
				}
				divLoading.style.display = "flex";
				let request = (window.XMLHttpRequest) ? 
							new XMLHttpRequest() : 
							new ActiveXObject('Microsoft.XMLHTTP');
				let ajaxUrl = BASE_URL+'Login/setPassword'; 
				let formData = new FormData(formCambiarPass);
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
                				button:"Iniciar Sesion",
							}). then((isConfirm) => {
								if (isConfirm) {
									window.location = BASE_URL+'Login';
								}
							});
						}else{
							swal("Atencion",objData.msg, "error");
						}
					}else{
						swal("Atencion","Error en el proceso", "error");
					}
					divLoading.style.display = "none";
					return false;
				}
			}
		}
	}
},false);