function fntValidTelefono() {
    let valiCell = document.querySelectorAll(".valiTelefono");
    valiCell.forEach(function (valiCell) {
        let LimiteElemCell = 8;
        fntValNumeros(valiCell,LimiteElemCell);
    })
}
function fntVAlidDni() {
    let validDni = document.querySelectorAll(".validDni");
    
    validDni.forEach(function (validDni) {
        let LimiteElemDni = 7; 
        fntValNumeros(validDni, LimiteElemDni);
  });
}
function fntValidRuc() {
    let validRuc = document.querySelectorAll(".validRuc");
    validRuc.forEach(function (validRuc) {
        let LimiteElemRuc = 10;
        fntValNumeros(validRuc, LimiteElemRuc);
    });
}
function fntValNumeros(paramClass,LimiteElemntos) {
    paramClass.addEventListener("keydown", function (e) {
        let tecla = e.key;
        let dni = this.value;

        let keyboard = tecla == "Backspace" || tecla == "Tab" ||tecla == "ArrowRight" ||tecla == "ArrowLeft";
        if (dni.length <= LimiteElemntos  ) {
          if ((tecla >= 0 && tecla <= 9) || keyboard) {
            return true;
          } else {
            e.preventDefault();
          }
        }else {
            if (keyboard) {
              return true;
            } else {
              e.preventDefault();
            }
        }
    });
}
function controlTag(e) {

    tecla = (document.all) ? e.key : e.code;
    if (tecla==8) return true; 
    else if (tecla == 0 || tecla == 9) return true;
    patron =/[0-9\s]/;
    n = String.fromCharCode(tecla);
    return patron.test(n); 
}

function testText(txtString) {
   
    var stringText = new RegExp(/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/);
    if(stringText.test(txtString)){
        return true;
    }else{
        return false;
    }
}

function testEntero(intCant){
    var intCantidad = new RegExp(/^([0-9])*$/);
    if(intCantidad.test(intCant)){
        return true;
    }else{
        return false;
    }
}
function fntEmailValidate(email){
    var stringEmail = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    if (stringEmail.test(email) == false){
        return false;
    }else{
        return true;
    }
}



function fntValidText(){
    let validText = document.querySelectorAll(".validText");
    validText.forEach(function (validText) {
        
        validText.addEventListener('keyup', function () {
            
            let inputValue = this.value;
            let cont = inputValue.length;
            if (testText(inputValue) || cont == 0) { 
                this.classList.remove("is-invalid");
            }else{ 
                this.classList.add('is-invalid');
            }
        });
	});
}


function fntValidNumber(){
	let validNumber = document.querySelectorAll(".validNumber");
    validNumber.forEach(function(validNumber) {
        validNumber.addEventListener('keyup', function(){
            let inputValue = this.value;
            if (!testEntero(inputValue)) {
                
				this.classList.add('is-invalid');
			}else{
				this.classList.remove('is-invalid');
			}				
		});
	});
}

function fntValidEmail(){
	let validEmail = document.querySelectorAll(".validEmail");
    validEmail.forEach(function(validEmail) {
        validEmail.addEventListener('keyup', function(){
            let inputValue = this.value;
            let cont = inputValue.length;
			if(fntEmailValidate(inputValue) || cont==0 ){
				this.classList.remove('is-invalid');
			}else{
				this.classList.add('is-invalid');
			}				
		});
	});
}

window.addEventListener('load', function() {
	fntValidText();
	fntValidEmail(); 
    fntValidNumber();
    fntVAlidDni();
    fntValidRuc();
    fntValidTelefono();
}, false);